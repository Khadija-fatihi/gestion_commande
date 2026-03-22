<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = [
        'client_id',
        'date_commande',
        'statut',
        'total',
        'notes',
    ];

    protected $casts = [
        'date_commande' => 'date',
        'total' => 'decimal:2',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(DetailCommande::class);
    }

    public function historiques(): HasMany
    {
        return $this->hasMany(HistoriqueCommande::class);
    }
}
