<?php

namespace App\Observers;

use App\Models\Address;

class AddressObserver
{
    public function creating(Address $address): void
    {
        if ($address->user->addresses()->where('is_primary', true)->count() === 0) {
            $address->is_primary = true;
        }
    }

    /**
     * Handle the Address "created" event.
     */
    public function created(Address $address): void
    {
        //
    }

    /**
     * Handle the Address "updated" event.
     */
    public function updated(Address $address): void
    {
        //
    }

    /**
     * Handle the Address "deleted" event.
     */
    public function deleted(Address $address): void
    {
        //
    }

    /**
     * Handle the Address "restored" event.
     */
    public function restored(Address $address): void
    {
        //
    }

    /**
     * Handle the Address "force deleted" event.
     */
    public function forceDeleted(Address $address): void
    {
        //
    }
}
