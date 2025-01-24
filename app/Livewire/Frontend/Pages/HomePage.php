<?php

namespace App\Livewire\Frontend\Pages;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toastable;

#[Layout('layouts.app')]
class HomePage extends Component
{
    use Toastable;

    public function render()
    {
        return view('livewire.frontend.pages.home-page', [
        ])->layoutData([
            'title' => __('Home'),
        ]);
    }

    #[On('subscribe')]
    public function subscribe($email): void
    {
        $validatedData = Validator::make(['email' => $email], [
            'email' => 'required|email',
        ]);

        if ($validatedData->fails()) {
            $this->error($validatedData->errors()->first());

            return;
        }

        Subscriber::createOrFirst([
            'email' => $email,
        ]);

        $this->success(__('You have been subscribed successfully to our newsletter.'));
        $this->dispatch('subscribed');
    }

    #[Computed]
    public function categories()
    {
        return Category::all();
    }

    #[Computed]
    public function popularCategories()
    {
        return Category::where('is_popular', 1)->get();
    }

    #[Computed]
    public function mostDiscountedCategories()
    {
        return Category::discounted()->get();
    }

    #[Computed]
    public function featuredProducts()
    {
        return Product::featured()->limit(8)->get();
    }

    #[Computed]
    public function banners()
    {
        return Banner::active()->ordered()->get();
    }
}
