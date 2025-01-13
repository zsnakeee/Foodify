<?php

namespace App\Livewire\Frontend\Pages\Payment;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class SuccessPage extends Component
{
    public $title;

    public $order_id;

    public function mount(): void
    {
        $this->title = __('Order Completed');
    }

    public function render()
    {
        $order = Order::my()->findOrFail($this->order_id);
        return view('livewire.frontend.pages.payment.success-page', compact('order'))
            ->layoutData([
                'title' => $this->title,
            ]);
    }
}
