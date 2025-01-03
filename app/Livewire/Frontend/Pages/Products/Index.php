<?php

namespace App\Livewire\Frontend\Pages\Products;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public $categories;

    public $brands;

    public $minPrice;

    public $maxPrice;

    public $inStockCount;

    public $outOfStockCount;

    public function mount(): void
    {
        $this->categories = Category::active()->whereHas('products', function ($query) {
            $query->active();
        })->pluck('id')->toArray();
        $this->brands = Brand::whereHas('products', function ($query) {
            $query->active();
        })->pluck('id')->toArray();
        $this->minPrice = Product::active()->min('price');
        $this->maxPrice = Product::active()->max('price');
        $this->inStockCount = Product::active()->inStock()->count();
        $this->outOfStockCount = Product::active()->outOfStock()->count();
    }

    public function render()
    {
        return view('livewire.frontend.pages.products.index')
            ->layoutData([
                'breadcrumb' => __('Products'),
                'title' => __('Products'),
            ]);
    }
}
