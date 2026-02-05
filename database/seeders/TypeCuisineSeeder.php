<?php

namespace Database\Seeders;

use App\Models\TypeCuisine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeCuisineSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cuisineTypes = [
            ['titre' => 'Française'],
            ['titre' => 'Italienne'],
            ['titre' => 'Japonaise'],
            ['titre' => 'Chinoise'],
            ['titre' => 'Mexicaine'],
            ['titre' => 'Indienne'],
            ['titre' => 'Thaïlandaise'],
            ['titre' => 'Libanaise'],
            ['titre' => 'Marocaine'],
            ['titre' => 'Américaine'],
            ['titre' => 'Espagnole'],
            ['titre' => 'Grecque'],
            ['titre' => 'Turque'],
            ['titre' => 'Vietnamienne'],
            ['titre' => 'Coréenne'],
        ];

        foreach ($cuisineTypes as $type) {
            TypeCuisine::create($type);
        }
    }
}
