<?php

namespace App\Listeners;

use App\Events\CommandeUpdated;
use App\Models\HistoriqueCommande;
use Illuminate\Support\Facades\Auth;

class EnregistrerHistoriqueCommande
{
    public function handle(CommandeUpdated $event): void
    {
        HistoriqueCommande::create([
            'commande_id' => $event->commande->id,
            'user_id' => Auth::id(),
            'action' => $event->action,
            'ancienne_valeur' => $event->ancienneValeur,
            'nouvelle_valeur' => $event->nouvelleValeur,
        ]);
    }
}
