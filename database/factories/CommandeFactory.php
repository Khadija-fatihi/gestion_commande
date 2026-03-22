<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Commande;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commande>
 */
class CommandeFactory extends Factory
{
    protected $model = Commande::class;

    public function definition(): array
    {
        return [
            'client_id' => \App\Models\Client::factory(),
            'date_commande' => fake()->dateTimeBetween('-1 year', 'now'),
            'total' => 0.0,
            'statut' => fake()->randomElement(['en_attente', 'validee', 'annulee']),
        ];
    }
}

