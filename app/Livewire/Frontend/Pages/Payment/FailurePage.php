<?php

namespace App\Livewire\Frontend\Pages\Payment;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class FailurePage extends Component
{
    public $title;

    public $message;

    public function mount(): void
    {
        $this->title = __('Payment Failure');
        $this->message ??= __('Your payment has been failed due to some reasons. Please try again.');
    }

    public function render()
    {
        return view('livewire.frontend.pages.payment.failure-page')
            ->layoutData([
                'title' => $this->title,
                'pageTitle' => $this->title,
            ]);
    }
}
