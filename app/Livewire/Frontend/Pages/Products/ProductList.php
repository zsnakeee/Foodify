<?php

namespace App\Livewire\Frontend\Pages\Products;

use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap-custom';

    public $readyToLoad = false;

    public $search;

    public $sort = 'default';

    public $category;

    protected $withCount = ['relation'];

    #[Url]
    public $filters = [
        'category' => null,
        'brand' => null,
        'priceRange' => null,
        'availability' => null,
    ];

    public function render()
    {
        return view('livewire.frontend.pages.products.product-list', [
            'products' => $this->readyToLoad ? $this->products() : collect(),
        ]);
    }

    #[On('applyFilters')]
    public function applyFilters($filters): void
    {
        $this->filters = $filters;
        $this->resetPage();
    }

    protected function products()
    {
        //        sleep(1); // Simulate slow loading
        return Product::when($this->category, fn ($query) => $query->where('category_id', $this->category->id))
            ->filter($this->filters)
            ->paginate(12);
    }
}
