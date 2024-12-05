<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SortieStock extends Model
{
    use HasFactory;

    protected $table = 'sortie_stock';

    protected $fillable = [
        'produit_id',
        'quantite',
        'destination',
        'type_usage',
        'raison',
        'date_sortie',
        'valide',
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
