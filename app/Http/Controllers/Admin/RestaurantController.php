<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = DB::table('restaurants')
            ->leftJoin('users', 'restaurants.user_id', '=', 'users.id')
            ->leftJoin('types_cuisine', 'types_cuisine.id', '=', 'restaurants.typeCuisine_id')
            ->select(
                'restaurants.*',
                'users.name as username',
                'users.email as user_email',
                'types_cuisine.nom as type_cuisine'
            )
            ->paginate(15);
        $Ids = $restaurants->pluck('id');
        $photos = DB::table('photos')->whereIn('restaurant_id', $Ids)->groupBy('restaurant_id');
        $menus = DB::table('menus')->whereIn('restaurant_id', $Ids)->groupBy('restaurant_id');
        $horaires = DB::table('horaires')->whereIn('restaurant_id', $Ids)->groupBy('restaurant_id');
        foreach ($restaurants as $restaurant) {
            $restaurant->photos = $photos;
            $restaurant->menus = $menus;
            $restaurant->horaires = $horaires;
        }
        return view('admin.restaurants', compact('restaurants'));
    }

    public function destroy(Restaurant $restaurant)
    {
        DB::table('photos')->where('restaurant_id', $restaurant->id)->delete();
        DB::table('menus')->where('restaurant_id', $restaurant->id)->delete();
        DB::table('horaires')->where('restaurant_id', $restaurant->id)->delete();
        DB::table('favoris')->where('restaurant_id', $restaurant->id)->delete();
        $restaurant->delete();
        return redirect()->route('admin.restaurants.index');
    }
}
