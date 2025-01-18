<?php

namespace App\Observers;

use App\Enums\PaymentStatus;
use App\Models\Order;
use App\Notifications\OrderPaid;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        if ($order->isDirty('payment_status') && $order->payment_status === PaymentStatus::PAID) {
            dispatch(function () use ($order) {
                $order->decrementStock();
                $order->user->notify(new OrderPaid($order));
            });
        }
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
