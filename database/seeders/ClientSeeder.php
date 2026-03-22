<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            ['nom' => 'Alpha SARL', 'email' => 'contact@alpha.test', 'telephone' => '0600000001', 'adresse' => 'Rabat'],
            ['nom' => 'Beta Distribution', 'email' => 'contact@beta.test', 'telephone' => '0600000002', 'adresse' => 'Casablanca'],
            ['nom' => 'Gamma Services', 'email' => 'contact@gamma.test', 'telephone' => '0600000003', 'adresse' => 'Marrakech'],
        ];

        foreach ($clients as $client) {
            Client::updateOrCreate(['email' => $client['email']], $client);
        }
    }
}
