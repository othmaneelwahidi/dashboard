<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'sku',
        'code_barre',
        'prix',
        'qte_min',
        'qte_max',
        'fournisseur',
    ];

    /**
     * Get the categories associated with the product.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category');
    }

    public function stockMovements()
    {
        return $this->hasMany(Stock::class);
    }

    public function stock()
    {
        return $this->hasOne(Stock::class, 'product_id');
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
