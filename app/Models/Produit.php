<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = [
        'nom',
        'description',
        'prix',
        'stock',
    ];

    public function detailsCommandes(): HasMany
    {
        return $this->hasMany(DetailCommande::class);
    }
}
