<?php

namespace App\Livewire\Frontend\Pages\Orders;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class View extends Component
{
    public $order;

    public function render()
    {
        Order::my()->findOrFail($this->order);

        return view('livewire.frontend.pages.orders.view')
            ->layoutData([
                'title' => __('Order Details'),
                'pageTitle' => __('My Orders'),
            ]);
    }
}
