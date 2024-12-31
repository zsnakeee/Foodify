<?php

namespace App\Livewire\Frontend\Pages\Categories;

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Categories')]
class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap-custom';
    public $breadcrumb = 'Categories';

    public function render()
    {
        $categories = Category::paginate(10);
        return view('livewire.frontend.pages.categories.index', ['categories' => $categories])->layoutData([
            'breadcrumb' => $this->breadcrumb,
        ]);
    }
}
