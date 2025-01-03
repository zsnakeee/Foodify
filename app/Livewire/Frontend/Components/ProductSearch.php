<?php

namespace App\Livewire\Frontend\Components;

use App\Models\Product;
use App\Services\Cart\ExtendedCart;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ProductSearch extends Component
{
    #[Validate('string')]
    public $search = '';

    public $products = [];

    public function mount(): void
    {
        $this->refreshProducts();
    }

    public function render()
    {
        return view('livewire.frontend.components.product-search');
    }

    public function updatedSearch(): void
    {
        $this->validate();

        if (strlen($this->search) < 3) {
            $this->refreshProducts();
            return;
        }

        $this->products = Product::search($this->search)->limit(7)->get();
    }

    #[On('add-to-recent-searches')]
    public function addToRecentSearches($id): void
    {
        $product = Product::find($id);
        $cart = app(ExtendedCart::class)->recentSearches();
        $cart->add($product);
        $this->products = $cart->products()->take(7);
        $this->redirect(route('products.view', $product), navigate: true);
    }

    protected function refreshProducts(): void
    {
        $cart = app(ExtendedCart::class)->recentSearches();
        $this->products = $cart->count() === 0 ? Product::featured()->limit(7)->get() : $cart->products()->take(7);
    }
}
