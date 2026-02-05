<?php

namespace Database\Factories;

use App\Models\Restaurant;
use App\Models\TypeCuisine;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    protected $model = Restaurant::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $restaurantNames = [
            'Le Petit Bistro',
            'Chez Marie',
            'La Table Gourmande',
            'Restaurant du Coin',
            'Le Bon Vivant',
            'Casa Bella',
            'Trattoria Roma',
            'Pizzeria Napoli',
            'Tokyo Express',
            'Wasabi House',
            'Golden Wok',
            'Peking Garden',
            'Taco Fiesta',
            'Cantina Mexicana',
            'Spice Palace',
            'Curry House',
            'Thai Basil',
            'Mango Tree',
            'Cedar Lounge',
            'Medina Restaurant',
        ];

        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'nom' => fake()->randomElement($restaurantNames) . ' ' . fake()->city(),
            'localisation' => fake()->streetAddress() . ', ' . fake()->city(),
            'typeCuisine_id' => TypeCuisine::inRandomOrder()->first()?->id ?? TypeCuisine::factory(),
            'capacite' => fake()->numberBetween(30, 150),
        ];
    }
}
