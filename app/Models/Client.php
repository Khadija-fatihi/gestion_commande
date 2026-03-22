<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'nom',
        'email',
        'telephone',
        'adresse',
    ];

    public function commandes(): HasMany
    {
        return $this->hasMany(Commande::class);
    }
}
