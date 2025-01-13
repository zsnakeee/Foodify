<div>
    <section class="flat-spacing-11">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <livewire:frontend.components.profile-navtab tab="addresses"/>
                </div>

                <div class="col-lg-9">
                    <button class="tf-btn bg-primary text-white animate-hover-btn justify-content-center mb-3"
                            wire:click="create">{{ __('Add a New Address') }}</button>

                    <div class="row">
                        @foreach($addresses as $address)
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-actions p-2 mb-0 pb-0 d-flex justify-content-end">
                                        <button wire:click="edit({{ $address->id }})" class="btn btn-sm">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>

                                        <button wire:click="delete({{ $address->id }})" class="btn btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>

                                    <div class="card-body mt-0 pt-1">
                                        <h6 class="card-title fw-6 d-flex gap-2 align-items-center">
                                            {{ __('Address') }} #{{ $loop->iteration }}
                                            @if($address->is_primary)
                                                <span class="badge badge-primary">{{ __('Default') }}</span>
                                            @endif
                                        </h6>
                                        <p class="card-text">{{ $address->name }}</p>
                                        <p class="card-text">{{ $address->address }}</p>
                                        <p class="card-text">{{ $address->city }}</p>
                                        <p class="card-text">{{ $address->phone }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-modal wire:model="showCreateModal" name="{{ __('Add') }}">
        <x-form.input wire:model="state.name" name="name" class="mt-3 w-100"/>
        <x-form.input wire:model="state.address" name="address" class="w-100"/>
        <x-form.input wire:model="state.city" name="city" class="w-100"/>
        <x-form.input wire:model="state.phone" name="phone" class="w-100"/>
        <x-form.input wire:model="state.postal_code" name="postal_code" class="w-100"/>
        <x-form.checkbox wire:model="state.is_primary" name="is_primary" label="{{ __('Set as primary') }}"/>

        <x-slot name="footer">
            <button type="button" class="tf-btn bg-primary text-white animate-hover-btn justify-content-center"
                    wire:click="createAction">{{ __('Create') }}</button>
        </x-slot>
    </x-modal>

    <x-modal wire:model="showEditModal" name="{{ __('Edit') }}">
        <x-form.input wire:model="state.name" name="name" class="mt-3 w-100"/>
        <x-form.input wire:model="state.address" name="address" class="w-100"/>
        <x-form.input wire:model="state.city" name="city" class="w-100"/>
        <x-form.input wire:model="state.phone" name="phone" class="w-100"/>
        <x-form.input wire:model="state.postal_code" name="postal_code" class="w-100"/>
        <x-form.checkbox wire:model="state.is_primary" name="is_primary" label="{{ __('Set as primary') }}"/>

        <x-slot name="footer">
            <button type="button" class="tf-btn bg-primary text-white animate-hover-btn justify-content-center"
                    wire:click="updateAction">{{ __('Update') }}</button>
        </x-slot>
    </x-modal>

    <x-modal wire:model="showDeleteModal" name="{{ __('Delete') }}">
        <div class="modal-body">
            <h6>{{ __('Are you sure you want to delete this address?') }}</h6>
        </div>

        <x-slot name="footer">
            <button type="button" class="tf-btn bg-danger text-white animate-hover-btn justify-content-center"
                    wire:click="deleteAction">{{ __('Delete') }}</button>
        </x-slot>
    </x-modal>

</div>
