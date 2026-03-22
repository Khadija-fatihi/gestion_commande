<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Commande;
use Illuminate\Database\Seeder;

class CommandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clientIds = Client::pluck('id')->all();
        if ($clientIds === []) {
            return;
        }

        foreach (range(1, 12) as $i) {
            Commande::create([
                'client_id' => $clientIds[array_rand($clientIds)],
                'date_commande' => now()->subDays(rand(1, 60))->toDateString(),
                'statut' => collect(['en_attente', 'validee', 'expediee', 'livree'])->random(),
                'total' => 0,
                'notes' => 'Commande test #'.$i,
            ]);
        }
    }
}
