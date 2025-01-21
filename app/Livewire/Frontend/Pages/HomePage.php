<?php

namespace App\Livewire\Frontend\Pages;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class HomePage extends Component
{
    public function render()
    {
        return view('livewire.frontend.pages.home-page', [
        ])->layoutData([
            'title' => __('Home'),
        ]);
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
