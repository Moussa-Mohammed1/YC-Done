<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function show(Restaurant $restaurant)
    {
        
        return view('user.reservations');
    }
}
