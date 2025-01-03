<?php

namespace App\Livewire\Frontend\Pages\Products;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Url;
use Livewire\Component;

class Filter extends Component
{
    public $categories = [];

    public $brands = [];

    public $minPrice = 0;

    public $maxPrice = 0;

    public $inStockCount = 0;

    public $outOfStockCount = 0;

    public $availability = 'all';

    public $selectedCategory;

    public $selectedBrand;

    public $selectedMinPrice;

    public $selectedMaxPrice;

    public $hasFilters = false;

    #[Url]
    public $filters = [
        'category' => null,
        'brand' => null,
        'priceRange' => null,
        'availability' => null,
    ];

    public function mount(): void
    {
        $this->handleCategoryAndBrand();
        $this->updateHasFilter();
        $this->handleQueryParams();
    }

    public function render()
    {
        $this->categories = $this->categories ? $this->categories->loadCount('products') : [];
        $this->brands = $this->brands ? $this->brands->loadCount('products') : [];

        return view('livewire.frontend.pages.products.filter');
    }

    public function toggleBrand($brand): void
    {
        $this->selectedBrand = $this->selectedBrand == $brand ? null : $brand;
        $this->updated();
    }

    public function toggleCategory($category): void
    {
        $this->selectedCategory = $this->selectedCategory == $category ? null : $category;
        $this->updated();
    }

    public function resetFilters(): void
    {
        $this->selectedCategory = null;
        $this->selectedBrand = null;
        $this->selectedMinPrice = $this->minPrice;
        $this->selectedMaxPrice = $this->maxPrice;
        $this->availability = 'all';
        $this->filters = collect($this->filters)->map(fn () => null)->toArray();
        $this->updateAvailabilityCount();
        $this->updateHasFilter();
        $this->dispatch('applyFilters', $this->filters);
    }

    public function updated(): void
    {
        $this->filters = [
            'category' => $this->selectedCategory ?? null,
            'brand' => $this->selectedBrand ?? null,
            'priceRange' => [$this->selectedMinPrice, $this->selectedMaxPrice],
            'availability' => $this->availability === 'all' ? null : $this->availability,
        ];

        $this->updateAvailabilityCount();
        $this->updateHasFilter();
        $this->dispatch('applyFilters', $this->filters);
    }

    protected function handleCategoryAndBrand(): void
    {
        if ($this->categories) {
            $this->categories = Category::whereIn('id', $this->categories)
                ->withCount('products')
                ->orderByDesc('products_count')
                ->get();
        }

        if ($this->brands) {
            $this->brands = Brand::whereIn('id', $this->brands)
                ->withCount('products')
                ->orderByDesc('products_count')
                ->get();
        }
    }

    protected function handleQueryParams(): void
    {
        $this->selectedCategory = $this->filters['category'] ?? null;
        $this->selectedBrand = $this->filters['brand'] ?? null;
        $this->selectedMinPrice = $this->filters['priceRange'][0] ?? $this->minPrice;
        $this->selectedMaxPrice = $this->filters['priceRange'][1] ?? $this->maxPrice;
        $this->availability = $this->filters['availability'] ?? 'all';
    }

    protected function updateAvailabilityCount(): void
    {
        $this->inStockCount = Product::active()->inStock()->filter($this->filters)->count();
        $this->outOfStockCount = Product::active()->outOfStock()->filter($this->filters)->count();
    }

    protected function updateHasFilter(): void
    {
        $this->hasFilters = collect($this->filters)->filter()->isNotEmpty();
    }
}
