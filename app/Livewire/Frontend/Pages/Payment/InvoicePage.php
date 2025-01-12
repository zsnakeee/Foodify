<?php

namespace App\Livewire\Frontend\Pages\Payment;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.empty')]
class InvoicePage extends Component
{
    public $order_id;

    public function render()
    {
        $order = Order::findOrFail($this->order_id);

        return view('livewire.frontend.pages.payment.invoice-page', compact('order'))
            ->layoutData([
                'title' => __('Invoice'),
            ]);
    }
}
