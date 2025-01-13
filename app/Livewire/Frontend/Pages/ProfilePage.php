<?php

namespace App\Livewire\Frontend\Pages;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Masmerise\Toaster\Toastable;

#[Layout('layouts.app')]
class ProfilePage extends Component
{
    use Toastable;

    public User $user;

    public $name;

    public $current_password;

    public $new_password;

    public $new_password_confirmation;

    public function mount(): void
    {
        $this->user = auth()->user();
        $this->name = $this->user->name;
    }

    public function render()
    {
        return view('livewire.frontend.pages.profile-page')
            ->layoutData([
                'title' => __('Profile'),
                'pageTitle' => __('Profile'),
            ]);
    }

    public function update(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = auth()->user();
        if ($this->name != $user->name) {
            $user->name = $this->name;
            $user->save();
            $this->success(__('Profile updated successfully.'));

            return;
        }

        $this->info(__('Nothing to update.'));
    }

    public function updatePassword(): void
    {
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);

        $user = auth()->user();

        if (password_verify($this->new_password, $user->password)) {
            $this->addError('new_password', __('You cannot use the same password.'));

            return;
        }

        if (! password_verify($this->current_password, $user->password)) {
            $this->addError('current_password', __('The provided password does not match your current password.'));

            return;
        }

        $user->password = bcrypt($this->new_password);
        $user->save();

        $this->success(__('Password changed successfully.'));
    }
}
