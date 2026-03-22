<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Produit;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produit>
 */
class ProduitFactory extends Factory
{
    protected $model = Produit::class;

    public function definition(): array
    {
        return [
            'nom' => fake()->words(2, true),
            'description' => fake()->sentence(),
            'prix_unitaire' => fake()->randomFloat(2, 10, 500),
            'stock' => fake()->numberBetween(1, 100),
        ];
    }
}

