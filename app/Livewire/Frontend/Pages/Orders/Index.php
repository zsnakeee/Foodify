<?php

namespace App\Livewire\Frontend\Pages\Orders;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public function render()
    {
        $orders = Order::my()->latest()->paginate(10);

        return view('livewire.frontend.pages.orders.index', compact('orders'))
            ->layoutData([
                'title' => __('My Orders'),
                'pageTitle' => __('My Orders'),
            ]);
    }
}
