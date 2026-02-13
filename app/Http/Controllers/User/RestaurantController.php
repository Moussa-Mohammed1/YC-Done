<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Photo;
use App\Models\Restaurant;
use App\Models\TypeCuisine;
use App\Models\Plat;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function create()
    {
        $typeCuisines = TypeCuisine::all();
        $plats = Plat::all();
        return view('user.createRestaurant', compact('typeCuisines', 'plats'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'typeCuisine_id' => 'required|exists:types_cuisine,id',
            'localisation' => 'required|string|max:255',
            'capacite' => 'required|integer|min:1',
            'status' => 'nullable|in:ACTIVE,INACTIVE',
            'photo' => 'nullable|array',
            'photo.*' => 'nullable|image|max:5120',
            'horaires' => 'nullable|array',
            'horaires.*.jourSemaine' => 'required|string',
            'horaires.*.heureOuverture' => 'nullable|required_without:horaires.*.ferme',
            'horaires.*.heureFermeture' => 'nullable|required_without:horaires.*.ferme',
            'menutitle' => 'nullable|string|max:255',
            'plats' => 'nullable|array',
            'plats.*.contenu' => 'required_with:plats.*.prix|string|max:255',
            'plats.*.prix' => 'required_with:plats.*.contenu|numeric|min:0',
        ]);

        $restaurant = Restaurant::create([
            'user_id' => auth()->id(),
            'nom' => $validated['nom'],
            'typeCuisine_id' => $validated['typeCuisine_id'],
            'localisation' => $validated['localisation'],
            'capacite' => $validated['capacite'],
            'status' => $validated['status'] ?? 'ACTIVE',
        ]);
        if (!empty($validated['menutitle'])) {
            $menu = Menu::create([
                'title' => $validated['menutitle'],
                'restaurant_id' => $restaurant->id,
            ]);

            if (!empty($validated['plats'])) {
                foreach ($validated['plats'] as $plat) {
                    $menu->plats()->create([
                        'contenu' => $plat['contenu'],
                        'prix' => $plat['prix'],
                    ]);
                }
            }
        }

        foreach ($validated['horaires'] ?? [] as $date) {
            $isClosed = !empty($date['ferme']);
            if ($isClosed) {
                $restaurant->horaires()->create([
                    'jourSemaine' => $date['jourSemaine'],
                    'closed' => true,
                ]);
            } else {
                $heureOuverture = $date['heureOuverture'] ?? null;
                $heureFermeture = $date['heureFermeture'] ?? null;
                if ($heureOuverture === null || $heureFermeture === null) {
                    continue;
                }
                $restaurant->horaires()->create([
                    'jourSemaine' => $date['jourSemaine'],
                    'heureFermeture' => $heureFermeture,
                    'heureOuverture' => $heureOuverture,
                ]);
            }
        }
        $photosUrls =[];
        if ($request->hasFile('photo')) {
            foreach ($request->file('photo') as $photo ) {
                $photosUrls[] =  $photo->store('restaurant/images', 'public');
            }
        }
        foreach ($photosUrls as $path) {
            $restaurant->photos()->create([
                'contenu' => $path,
            ]);
        };
        return redirect()->route('myrestaurants')->with('success', 'Restaurant créé avec succès!');
    }

    public function show(Restaurant $restaurant)
    {
        
        $restaurant->load(['photos', 'typeCuisine', 'user', 'menus.plats', 'horaires']);
        return view('user.restaurant', compact('restaurant'));
    }


    public function owner()
    {
        $owner_id = auth()->user()->id;
        $restaurants = Restaurant::with(['menus.plats', 'photos', 'horaires', 'typeCuisine'])
                        ->where('user_id', '=', $owner_id)
                        ->get();
        return view('user.myrestaurants', compact('restaurants'));
    }

    public function edit(Restaurant $restaurant)
    {
        $restaurant->load(['photos', 'typeCuisine', 'user', 'menus.plats', 'horaires']);
        return view('user.editRestaurant', compact('restaurant'));
    }
}
