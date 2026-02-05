<?php

namespace Database\Factories;

use App\Models\TypeCuisine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TypeCuisine>
 */
class TypeCuisineFactory extends Factory
{
    protected $model = TypeCuisine::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cuisineTypes = [
            'Française', 'Italienne', 'Japonaise', 'Chinoise', 'Mexicaine',
            'Indienne', 'Thaïlandaise', 'Libanaise', 'Marocaine', 'Américaine',
            'Espagnole', 'Grecque', 'Turque', 'Vietnamienne', 'Coréenne',
            'Brésilienne', 'Argentine', 'Péruvienne', 'Éthiopienne', 'Fusion',
        ];

        return [
            'titre' => fake()->unique()->randomElement($cuisineTypes),
        ];
    }
}
