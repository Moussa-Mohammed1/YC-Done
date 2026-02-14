<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ReservationConfirmed;
use App\Models\Paiement;
use App\Models\Reservation;
use App\Models\Restaurant;
use App\Notifications\NewReservationNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        $validated = $request->validate([
            'restaurant_id' => ['required', 'exists:restaurants,id'],
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
            'guests' => ['required', 'integer', 'min:1'],
            'payment_method' => ['required', 'string'],
        ]);

        $restaurant = Restaurant::findOrFail($validated['restaurant_id']);
        if ($restaurant->status !== 'ACTIVE') {
            return response()->json([
                'success' => false,
                'message' => 'Restaurant indisponible pour le moment.',
            ]);
        }

        $pricePerPerson = $restaurant->reservation_price_per_person
            ?? config('services.stripe.price_per_person', 25);
        $amount = (int) round($pricePerPerson * $validated['guests'] * 100);
        if ($amount <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Montant de reservation invalide.',
            ]);
        }

        $startDateTime = Carbon::parse($validated['date'] . ' ' . $validated['time']);
        $durationMinutes = config('services.stripe.reservation_duration_minutes', 60);
        $endDateTime = $startDateTime->copy()->addMinutes($durationMinutes);

        $reservation = Reservation::create([
            'user_id' => $request->user()->id,
            'restaurant_id' => $restaurant->id,
            'day' => $startDateTime,
            'personnes' => $validated['guests'],
            'startHour' => $startDateTime->format('H:i:s'),
            'endHour' => $endDateTime->format('H:i:s'),
        ]);

        $user = $request->user();
        $user->createOrGetStripeCustomer();

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $amount,
                'currency' => 'eur',
                'customer' => $user->stripe_id,
                'payment_method' => $validated['payment_method'],
                'confirm' => true,
                'capture_method' => 'manual',
                'return_url' => route('user.home'),
                'metadata' => [
                    'reservation_id' =>  $reservation->id,
                    'restaurant_id' =>  $restaurant->id,
                    'user_id' => $user->id,
                ],
            ]);
        } catch (\Exception $exception) {
            $reservation->update(['status' => 'Echec paiement']);
            error_log($exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la creation du paiement: ' . $exception->getMessage(),
            ]);
        }
        $reservation->update(['status' => 'succeeded']);
        Paiement::create([
            'reservation_id' => $reservation->id,
            'montant' => $amount / 100,
            'status' => $paymentIntent->status,
            'stripe_payment_intent_id' => $paymentIntent->id,
        ]);
        
        $restaurant->user->notify(new NewReservationNotification($reservation));
        
        try {
            Mail::to($request->user())->send(new ReservationConfirmed($reservation));
        } catch (\Exception $e) {
            error_log('Error sending email: ' . $e->getMessage());
        }
        
        return response()->json([
            'success' => true,
            'client_secret' => $paymentIntent->client_secret,
            'payment_status' => $paymentIntent->status,
            'reservation_id' => $reservation->id,
        ]);
    }
}
