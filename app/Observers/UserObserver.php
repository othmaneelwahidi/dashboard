<?php

namespace App\Observers;

use App\Models\Action;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user)
    {
        Action::create([
            'user_id' => Auth::id(),
            'action' => 'add_user',
            'details' => 'Added user: ' . $user->name . ' (Email: ' . $user->email . ')',
        ]);
    }

    public function updated(User $user)
    {
        Action::create([
            'user_id' => Auth::id(),
            'action' => 'update_user',
            'details' => 'Updated user: ' . $user->name . ' (Email: ' . $user->email . ')',
        ]);
    }

    public function deleted(User $user)
    {
        Action::create([
            'user_id' => Auth::id(),
            'action' => 'delete_user',
            'details' => 'Deleted user: ' . $user->name . ' (Email: ' . $user->email . ')',
        ]);
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
