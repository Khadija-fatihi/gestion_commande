<?php

namespace Database\Seeders;

use App\Models\Commande;
use App\Models\DetailCommande;
use App\Models\Produit;
use Illuminate\Database\Seeder;

class DetailCommandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produits = Produit::all();
        if ($produits->isEmpty()) {
            return;
        }

        Commande::all()->each(function (Commande $commande) use ($produits): void {
            $selection = $produits->random(rand(1, min(3, $produits->count())));
            $total = 0;

            foreach ($selection as $produit) {
                $quantite = rand(1, 5);
                $sousTotal = $quantite * $produit->prix;
                $total += $sousTotal;

                DetailCommande::create([
                    'commande_id' => $commande->id,
                    'produit_id' => $produit->id,
                    'quantite' => $quantite,
                    'prix_unitaire' => $produit->prix,
                    'sous_total' => $sousTotal,
                ]);
            }

            $commande->update(['total' => $total]);
        });
    }
}
