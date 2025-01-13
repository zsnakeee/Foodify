<?php

namespace App\Livewire\Frontend\Tables;

use App\Models\Order;
use Livewire\Component;

class Orders extends Component
{
    public function render()
    {
        $orders = Order::my()->latest()->paginate(10);

        return view('livewire.frontend.tables.orders', compact('orders'));
    }
}
