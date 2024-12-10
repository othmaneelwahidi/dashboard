<?php

namespace App\Observers;

use App\Models\Action;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product)
    {
        $product=Product::all();
        Action::create([
            'user_id' => Auth::id(),
            'action' => 'add_product',
            'details' => 'Ajouter produit: ' . $product->name,
        ]);
    }

    // This will be called when a product is updated
    public function updated(Product $product)
    {
        Action::create([
            'user_id' => Auth::id(),
            'action' => 'update_product',
            'details' => 'Modifier produit: ' . $product->name,
        ]);
    }

    // This will be called when a product is deleted
    public function deleted(Product $product)
    {
        Action::create([
            'user_id' => Auth::id(),
            'action' => 'delete_product',
            'details' => 'Supprimer produit: ' . $product->name,
        ]);
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
