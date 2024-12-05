<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $table = 'produits';

    protected $fillable = [
        'catégorie',
        'sous_catégorie',
        'nom',
        'description',
        'sku',
        'code_barre',
        'prix',
        'quantité_minimale',
        'quantité_maximale',
        'fournisseur',
    ];
}
