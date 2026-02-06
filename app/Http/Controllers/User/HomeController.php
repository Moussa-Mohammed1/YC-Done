<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $userRestaurant = [];
        if (auth()->user()->hasRole('restaurant_owner')) {
            $userRestaurant = Restaurant::with('photos', 'types_cuisine', 'menus', 'horaires')->where('user_id', '=', auth()->user()->id)->get();
        }
        $restaurants = Restaurant::with('photos', 'typeCuisine', 'menus', 'horaires')->paginate(8);
        return view('user.home', compact('restaurants', 'userRestaurant'));
    }
}
