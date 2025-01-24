<?php

use App\Livewire\Frontend\Pages\ProfilePage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('renders the profile page correctly', function () {
    Livewire::test(ProfilePage::class)
        ->assertViewIs('livewire.frontend.pages.profile-page')
        ->assertSee('Profile');
});

it('updates the user profile successfully', function () {
    Livewire::test(ProfilePage::class)
        ->set('name', 'New Name')
        ->call('update')
        ->assertHasNoErrors();

    $this->assertEquals('New Name', $this->user->fresh()->name);
});

it('fails to update the user profile with invalid data', function () {
    Livewire::test(ProfilePage::class)
        ->set('name', '')
        ->call('update')
        ->assertHasErrors(['name' => 'required']);
});

it('updates the user password successfully', function () {
    $this->user->update(['password' => bcrypt('oldpassword')]);

    Livewire::test(ProfilePage::class)
        ->set('current_password', 'oldpassword')
        ->set('new_password', 'newpassword')
        ->set('new_password_confirmation', 'newpassword')
        ->call('updatePassword')
        ->assertHasNoErrors();

    $this->assertTrue(password_verify('newpassword', $this->user->fresh()->password));
});

it('fails to update the user password with invalid data', function () {
    $this->user->update(['password' => bcrypt('oldpassword')]);

    Livewire::test(ProfilePage::class)
        ->set('current_password', 'wrongpassword')
        ->set('new_password', 'newpassword')
        ->set('new_password_confirmation', 'newpassword')
        ->call('updatePassword')
        ->assertHasErrors(['current_password' => 'The provided password does not match your current password.']);
});
