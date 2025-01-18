<?php

namespace App\Livewire\Frontend\Pages\Categories;

use App\Models\Category;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class View extends Component
{
    public $category;

    public function mount($category): void
    {
        $this->category = Category::whereJsonContains('slug', $category)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.frontend.pages.categories.view')->layoutData([
            'breadcrumb' => $this->category->name,
            'title' => $this->category->name.' - '.__('Category'),
        ]);
    }

    #[Computed]
    public function brands(): array
    {
        return $this->category->products()->active()
            ->whereHas('brand')
            ->pluck('brand_id')
            ->unique()
            ->toArray();
    }

    #[Computed]
    public function minPrice(): int
    {
        return $this->category->products()->active()->min('price') ?? 0;
    }

    #[Computed]
    public function maxPrice(): int
    {
        return $this->category->products()->active()->max('price') ?? 0;
    }

    #[Computed]
    public function inStockCount(): int
    {
        return $this->category->products()->active()->inStock()->count() ?? 0;
    }

    #[Computed]
    public function outOfStockCount(): int
    {
        return $this->category->products()->active()->outOfStock()->count() ?? 0;
    }
}
