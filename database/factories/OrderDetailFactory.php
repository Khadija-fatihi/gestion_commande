<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OrderDetail;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    protected $model = OrderDetail::class;

    public function definition(): array
    {
        return [
            'commande_id' => \App\Models\Commande::factory(),
            'produit_id' => \App\Models\Produit::factory(),
            'quantite' => fake()->numberBetween(1, 10),
            'prix_unitaire' => fake()->randomFloat(2, 10, 100),
        ];
    }
}

