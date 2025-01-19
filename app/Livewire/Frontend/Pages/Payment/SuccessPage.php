<?php

namespace App\Livewire\Frontend\Pages\Payment;

use App\Models\Order;
use App\Services\Cart\ExtendedCart;
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

    public function render(ExtendedCart $cart)
    {
        $order = Order::my()->findOrFail($this->order_id);
        $cart->shopping()->content()->whereIn('id', $order->details->pluck('product_id'))->each(function ($item) use ($cart) {
            $cart->shopping()->remove($item->rowId);
        });

        return view('livewire.frontend.pages.payment.success-page', compact('order'))
            ->layoutData([
                'title' => $this->title,
            ]);
    }
}
