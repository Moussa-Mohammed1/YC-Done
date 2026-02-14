<?php
namespace App\Services;
use App\Models\Horaire;
use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Monolog\Processor\LoadAverageProcessor;

class ReservationService
{
    public function getDayAvailableHours(Restaurant $restaurant, Request $request)
    {
        $date = Carbon::parse($request->query('date'));
        $dayNames = [
            1 => 'Lundi',
            2 => 'Mardi',
            3 => 'Mercredi',
            4 => 'Jeudi',
            5 => 'Vendredi',
            6 => 'Samedi',
            7 => 'Dimanche',
        ];
        $dayName = $dayNames[$date->dayOfWeekIso] ;
        
        $horaire = $restaurant->horaires->firstWhere('jourSemaine', $dayName);
        
        if (!$horaire || empty($horaire->heureOuverture) || empty($horaire->heureFermeture)) {
            return response()->json([
                'success' => false,
                'message' => 'Restaurant fermé ce jour'
            ]);
        }
        
        $openTime = Carbon::createFromFormat('H:i:s', $horaire->heureOuverture);
        $closeTime = Carbon::createFromFormat('H:i:s', $horaire->heureFermeture);
        
        $hours = [];
        $current = $openTime->copy();
        
        while ($current->lt($closeTime)) {
            $hours[] = $current->format('H:i');
            $current->addHour();
        }
        
        return response()->json([
            'success' => true,
            'hours' => $hours,
            'day' => $dayName,
            'restaurant_id' => $restaurant->id
        ]);
    }

    public function getAvailableSeets(Restaurant $restaurant, $date, $time, $guests)
    {
        $reservationDateTime = Carbon::parse($date . ' ' . $time);
        
        $existingReservations = $restaurant->reservations()
            ->whereDate('day', $reservationDateTime->toDateString())
            ->whereIn('status', ['Confirme', 'Autorisation en attente'])
            ->get();
        
        
        $bookedSeats = 0;
        foreach ($existingReservations as $reservation) {
            $resStart = Carbon::parse($reservation->day . ' ' . $reservation->startHour);
            $resEnd = Carbon::parse($reservation->day . ' ' . $reservation->endHour);
            
            if ($reservationDateTime->between($resStart, $resEnd->subSecond()) || 
                $resStart->between($reservationDateTime, $reservationDateTime->copy()->addHour()->subSecond())) {
                $bookedSeats += $reservation->personnes;
            }
        }
        
        $availableSeats = $restaurant->capacite - $bookedSeats;
        
        return [
            'available' => $availableSeats >= $guests,
            'available_seats' => $availableSeats,
            'requested_seats' => $guests,
            'capacity' => $restaurant->capacite,
            'booked_seats' => $bookedSeats
        ];
    }

    public function checkAvailability(Restaurant $restaurant, Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'guests' => 'required|integer|min:1'
        ]);

        $availability = $this->getAvailableSeets(
            $restaurant, 
            $validated['date'], 
            $validated['time'], 
            $validated['guests']
        );

        if (!$availability['available']) {
            return response()->json([
                'success' => false,
                'message' => "Seulement {$availability['available_seats']} places disponibles pour ce créneau.",
                'data' => $availability
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Places disponibles pour votre réservation.',
            'data' => $availability
        ]);
    }

}