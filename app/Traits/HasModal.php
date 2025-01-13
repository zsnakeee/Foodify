<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait HasModal
{
    public bool $showEditModal = false;

    public bool $showDeleteModal = false;

    public bool $showCreateModal = false;

    public ?Model $selectedModel;

    public function create(): void
    {
        $this->showCreateModal = true;
        $this->onCreate();
    }

    public function edit($id): void
    {
        $this->showEditModal = true;
        $this->selectedModel = $this->model::findOrFail($id);
        $this->onEdit($id);
    }

    public function delete($id): void
    {
        $this->showDeleteModal = true;
        $this->selectedModel = $this->model::findOrFail($id);
        $this->onDelete($id);
    }

    protected function onEdit($id): void {}

    protected function onDelete($id): void {}

    protected function onCreate(): void {}
}
