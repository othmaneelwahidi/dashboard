<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AjustementStock extends Model
{
    use HasFactory;

    protected $table = 'ajustement_stock';

    protected $fillable = [
        'produit_id',
        'quantite_avant',
        'quantite_apres',
        'raison',
        'date_ajustement',
        'valide',
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
