<?php

namespace App\Livewire\Frontend\Pages\Products;

use App\Events\UserViewingProduct;
use App\Models\Product;
use App\Services\Cart\ExtendedCart;
use Cache;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class View extends Component
{
    public $product;

    public $holdersCount = 0;

    public $recentProducts = [];

    public function mount($product, ExtendedCart $cartService)
    {
        $this->product = Product::whereJsonContains('slug', $product)->firstOrFail();
        $this->holdersCount = $cartService->countItems();
        $this->recentProducts = Product::whereIn('id', $cartService->recentViews()->content()->pluck('id')->all() ?? [])->where('id', '!=', $this->product->id)->get();
        $cartService->recentViews()->add($this->product);
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
