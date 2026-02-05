<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\User;
use App\Models\TypeCuisine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = User::all();
        $cuisineTypes = TypeCuisine::all();
        
        if ($users->isEmpty() || $cuisineTypes->isEmpty()) {
            $this->command->error('Please seed users and cuisine types first!');
            return;
        }

        $restaurants = [
            [
                'nom' => 'Le Gourmet Parisien',
                'localisation' => '15 Avenue des Champs-Élysées, Paris',
                'capacite' => 80,
                'typeCuisine_id' => $cuisineTypes->where('titre', 'Française')->first()->id,
            ],
            [
                'nom' => 'Bella Italia',
                'localisation' => '23 Rue de la Paix, Lyon',
                'capacite' => 60,
                'typeCuisine_id' => $cuisineTypes->where('titre', 'Italienne')->first()->id,
            ],
            [
                'nom' => 'Sakura Sushi',
                'localisation' => '45 Boulevard Saint-Germain, Paris',
                'capacite' => 50,
                'typeCuisine_id' => $cuisineTypes->where('titre', 'Japonaise')->first()->id,
            ],
            [
                'nom' => 'Dragon d\'Or',
                'localisation' => '12 Rue du Commerce, Marseille',
                'capacite' => 100,
                'typeCuisine_id' => $cuisineTypes->where('titre', 'Chinoise')->first()->id,
            ],
            [
                'nom' => 'El Mariachi',
                'localisation' => '8 Place de la République, Toulouse',
                'capacite' => 70,
                'typeCuisine_id' => $cuisineTypes->where('titre', 'Mexicaine')->first()->id,
            ],
            [
                'nom' => 'Taj Mahal',
                'localisation' => '34 Rue de Rivoli, Paris',
                'capacite' => 90,
                'typeCuisine_id' => $cuisineTypes->where('titre', 'Indienne')->first()->id,
            ],
            [
                'nom' => 'Bangkok Street',
                'localisation' => '56 Avenue Jean Médecin, Nice',
                'capacite' => 45,
                'typeCuisine_id' => $cuisineTypes->where('titre', 'Thaïlandaise')->first()->id,
            ],
            [
                'nom' => 'Le Cèdre',
                'localisation' => '19 Rue Saint-Antoine, Bordeaux',
                'capacite' => 65,
                'typeCuisine_id' => $cuisineTypes->where('titre', 'Libanaise')->first()->id,
            ],
            [
                'nom' => 'Riad Marrakech',
                'localisation' => '27 Rue de la Victoire, Strasbourg',
                'capacite' => 55,
                'typeCuisine_id' => $cuisineTypes->where('titre', 'Marocaine')->first()->id,
            ],
            [
                'nom' => 'The American Diner',
                'localisation' => '42 Boulevard Haussmann, Paris',
                'capacite' => 120,
                'typeCuisine_id' => $cuisineTypes->where('titre', 'Américaine')->first()->id,
            ],
        ];

        // Create restaurants with random users
        foreach ($restaurants as $restaurant) {
            Restaurant::create([
                'user_id' => $users->random()->id,
                'nom' => $restaurant['nom'],
                'localisation' => $restaurant['localisation'],
                'capacite' => $restaurant['capacite'],
                'typeCuisine_id' => $restaurant['typeCuisine_id'],
            ]);
        }

        // Create additional random restaurants using factory
        if (class_exists(\Database\Factories\RestaurantFactory::class)) {
            Restaurant::factory(15)->create();
        }

        $this->command->info('Restaurants seeded successfully!');
    }
}
