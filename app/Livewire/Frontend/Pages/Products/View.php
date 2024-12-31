<?php

namespace App\Livewire\Frontend\Pages\Products;

use App\Models\Product;
use App\Services\Product\Cart;
use App\Services\Product\RecentViews;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class View extends Component
{
    public $product;
    public $holdersCount = 0;
    public $recentProducts = [];

    public function mount($product, RecentViews $recentViewsService): void
    {
        $this->product = Product::whereJsonContainsLocale('slug', app()->getLocale(), $product)->firstOrFail();
        $this->holdersCount = $this->product->carts->count();
        $this->recentProducts = Product::whereIn('id', $recentViewsService->get(10) ?? [])->where('id', '!=', $this->product->id)->get();
        $recentViewsService->add($this->product);
    }

    public function render()
    {
        return view('livewire.frontend.pages.products.view')
            ->layoutData([
                'title' => $this->product->name,
                'pageTitle' => $this->product->name,
                'breadcrumbs' => [
                    'Home' => route('home'),
                    $this->product->category->name => route('categories.view', $this->product->category),
                    $this->product->name => null,
                ],
            ]);
    }
}
