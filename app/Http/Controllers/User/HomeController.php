<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $userRestaurant = [];
        if (auth()->user()->hasRole('restaurant_owner')) {
            $userRestaurant = Restaurant::with('photos', 'typeCuisine', 'menus', 'horaires')->where('user_id', '=', auth()->user()->id)->get();
        }
        if ($request->filled('horaire') || $request->filled('query')) {
            $heureOuverture = '11:00';
            $heureFermeture = '23:00';
            if ($request->filled('horaire')) {
                $heureOuverture = explode('-', $request->input('horaire'))[0];
                $heureFermeture = explode('-', $request->input('horaire'))[1];
            }
            $query = $request->input('query');
            $restaurants = Restaurant::query();
        }

        $restaurants = Restaurant::with('photos', 'typeCuisine', 'menus', 'horaires')
                        ->withExists(['favoris as isFavoris' => function ($q){
                             $q->where('user_id', auth()->id());
                        }])
                        ->paginate(8);
        return view('user.home', compact('restaurants', 'userRestaurant'));
    }
}
