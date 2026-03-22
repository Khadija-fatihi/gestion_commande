<?php

namespace Database\Seeders;

use App\Models\Produit;
use Illuminate\Database\Seeder;

class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produits = [
            ['nom' => 'Ordinateur portable', 'description' => '15 pouces, 16 Go RAM', 'prix' => 8500, 'stock' => 20],
            ['nom' => 'Souris sans fil', 'description' => 'Bluetooth', 'prix' => 250, 'stock' => 120],
            ['nom' => 'Ecran 24 pouces', 'description' => 'Full HD', 'prix' => 1900, 'stock' => 35],
            ['nom' => 'Clavier mecanique', 'description' => 'AZERTY', 'prix' => 700, 'stock' => 50],
        ];

        foreach ($produits as $produit) {
            Produit::updateOrCreate(['nom' => $produit['nom']], $produit);
        }
    }
}
