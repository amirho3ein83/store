<?php

namespace App\Observers;

use App\Models\Address;
use App\Models\User;
use App\Models\Wallet;

class UserObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;

    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $user->wallet()->create([
            'balance' => 0,
        ]);

        $user->address()->create([
            'text' => 'S2r 1234 NW Bobcat Lane, St. Robert, MO ghgt',
            'zipcode' => '1789654-5224',
            'user_id' => 2,
            'recipient_name' => 'Robert Robertson',
            'mobile' => '555-1234'
        ]);
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
