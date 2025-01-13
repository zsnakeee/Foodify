<?php

namespace App\Livewire\Frontend\Components;

use App\Models\Order;
use Livewire\Component;

class OrderDetails extends Component
{
    public $order_id;

    public function render()
    {
        $order = Order::my()->with('details.product')->findOrFail($this->order_id);
        return view('livewire.frontend.components.order-details', compact('order'));
    }
}
