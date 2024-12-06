<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'attribute';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'poids',
        'dimension',
        'couleur',
        'marque',
        'autre',
    ];

    /**
     * Get the product associated with the attribute.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
