<?php

use App\Livewire\Frontend\Pages\AddressesPage;
use App\Models\Address;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('renders the addresses page correctly', function () {
    Livewire::test(AddressesPage::class)
        ->assertViewIs('livewire.frontend.pages.addresses-page')
        ->assertSee('Addresses');
});

it('creates a new address successfully', function () {
    Livewire::test(AddressesPage::class)
        ->set('state', [
            'name' => 'John Doe',
            'phone' => '1234567890',
            'address' => '123 Main St',
            'city' => 'Anytown',
            'is_primary' => true,
        ])
        ->call('createAction')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('addresses', [
        'user_id' => $this->user->id,
        'name' => 'John Doe',
        'phone' => '1234567890',
        'address' => '123 Main St',
        'city' => 'Anytown',
        'is_primary' => true,
    ]);
});

it('updates an address successfully', function () {
    $address = Address::create([
        'user_id' => $this->user->id,
        'name' => 'John Doe',
        'phone' => '1234567890',
        'address' => '123 Main St',
        'city' => 'Anytown',
        'is_primary' => true,
    ]);

    Livewire::test(AddressesPage::class)
        ->set('selectedModel', $address)
        ->set('state', [
            'name' => 'Jane Doe',
            'phone' => '0987654321',
            'address' => '456 Elm St',
            'city' => 'Othertown',
            'is_primary' => false,
        ])
        ->call('updateAction')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('addresses', [
        'id' => $address->id,
        'name' => 'Jane Doe',
        'phone' => '0987654321',
        'address' => '456 Elm St',
        'city' => 'Othertown',
        'is_primary' => false,
    ]);
});

it('deletes an address successfully', function () {
    $address = Address::create([
        'user_id' => $this->user->id,
        'name' => 'John Doe',
        'phone' => '1234567890',
        'address' => '123 Main St',
        'city' => 'Anytown',
        'is_primary' => true,
    ]);

    Livewire::test(AddressesPage::class)
        ->set('selectedModel', $address)
        ->call('deleteAction')
        ->assertHasNoErrors();

    $this->assertDatabaseMissing('addresses', [
        'id' => $address->id,
    ]);
});
