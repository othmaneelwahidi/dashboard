<?php

namespace App\Observers;

use App\Models\Action;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;

class StockObserver
{
    /**
     * Handle the Stock "created" event.
     */
    public function created(Stock $stock)
    {
        Action::create([
            'user_id' => Auth::id(),
            'action' => 'stock_movement',
            'details' => $stock->movement_type . ' of ' . $stock->quantity . ' units for product: ' . $stock->product->name,
        ]);
    }

    /**
     * Handle the Stock "updated" event.
     */
    public function updated(Stock $stock): void
    {
        //
    }

    /**
     * Handle the Stock "deleted" event.
     */
    public function deleted(Stock $stock): void
    {
        //
    }

    /**
     * Handle the Stock "restored" event.
     */
    public function restored(Stock $stock): void
    {
        //
    }

    /**
     * Handle the Stock "force deleted" event.
     */
    public function forceDeleted(Stock $stock): void
    {
        //
    }
}
