<?php

namespace App\Livewire\Frontend\Pages;

use App\Models\Address;
use App\Traits\HasModal;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Masmerise\Toaster\Toastable;

#[Layout('layouts.app')]
class AddressesPage extends Component
{
    use HasModal;
    use Toastable;

    protected $model = Address::class;

    public $state = [];

    public function render()
    {
        $addresses = auth()->user()->addresses()->limit(5)->get();

        return view('livewire.frontend.pages.addresses-page', compact('addresses'))
            ->layoutData([
                'title' => __('Addresses'),
                'pageTitle' => __('Addresses'),
            ]);
    }

    protected function onEdit($id): void
    {
        $this->state = $this->selectedModel->toArray();
    }

    protected function onCreate(): void
    {
        $this->state = [];
    }

    public function createAction(): void
    {
        Validator::make($this->state, [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
        ])->validate();

        if (! auth()->user()->addresses()->where('is_primary', true)->exists()) {
            $this->state['is_primary'] = true;
        }

        if (isset($this->state['is_primary']) && $this->state['is_primary']) {
            auth()->user()->addresses()->update(['is_primary' => false]);
        }

        auth()->user()->addresses()->create($this->state);
        $this->state = [];
        $this->success(__('Address created successfully!'));
        $this->showCreateModal = false;
    }

    public function updateAction(): void
    {
        Validator::make($this->state, [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
        ])->validate();

        if (isset($this->state['is_primary']) && $this->state['is_primary']) {
            auth()->user()->addresses()->update(['is_primary' => false]);
        }

        $this->selectedModel->update($this->state);
        $this->state = [];
        $this->success(__('Address updated successfully!'));
        $this->showEditModal = false;
    }

    public function deleteAction(): void
    {
        $this->selectedModel->delete();
        $this->success(__('Address deleted successfully!'));
        $this->showDeleteModal = false;
    }
}
