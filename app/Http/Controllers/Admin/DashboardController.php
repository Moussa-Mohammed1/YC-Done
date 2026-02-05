<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
     public function index()
    {
        $totalUsers = User::count();
        $totalRestaurants = DB::table('restaurants')->count();
        $latestRestaurants = DB::table('restaurants')
                            ->orderBy('created_at', 'desc')->limit(5)->get();
        return view('admin.dashboard', compact('totalUsers', 'totalRestaurants'));
    }
}
