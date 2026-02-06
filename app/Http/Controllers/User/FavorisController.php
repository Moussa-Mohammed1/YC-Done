<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Favoris;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class FavorisController extends Controller
{
    public function destroy(Request $request)
    {
        $user_id = $request->input('user_id');
        $restaurant_id = $request->input('restaurant_id');
        Favoris::where('user_id', '=', $user_id)
                ->where('restaurant_id', '=', $restaurant_id)
                ->delete();
        return response()->json([
            'message' => 'Supprimé de favoris aved success'
        ]);
    }
    public function store(Request $request)
    {
        $user_id = $request->input('user_id');
        $restaurant_id = $request->input('restaurant_id');
        Favoris::create([
            'user_id' => $user_id,
            'restaurant_id' => $restaurant_id
        ]);
        return response()->json([
            'message' => 'Ajouté aux favoris avec success'
        ]);
    }
}
