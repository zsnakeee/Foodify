<div class="form-checkout">
    @if(count($addresses))
        <div class="d-flex flex-column gap-3 mb-4">
            <p>{{ __('Select an Address or Add a New One') }}</p>
            @foreach( $addresses as $address)
                <div class="card"
                     style="cursor: pointer;  @if($address_id == $address->id)  background-color: #61b4824a @endif"
                     wire:click="$set('address_id', {{ $address->id }})">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <strong>{{ $address->address }}, {{ $address->city }}</strong>
                                @if($address->is_primary)
                                    <span class="me-3 badge bg-dark">{{ __('Primary') }}</span>
                                @endif
                                <p>{{ $address->phone }}</p>
                            </div>

                            <div>
                                <button class="btn btn-sm text-secondary btn-sm">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="card"
                 style="cursor: pointer; @if(!$address_id)  background-color: #61b4824a @endif"
                 wire:click="$set('address_id', null)">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <strong>{{ __('Add a New Address') }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <!-- New Address Form (Shown Only if "Add a New Address" is Selected) -->
    @if(!$address_id)
        <fieldset class="box fieldset">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" id="name" wire:model="name"
                   required @class(['form-control is-invalid' => $errors->has('name')])>
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </fieldset>

        @guest
            <fieldset class="box fieldset">
                <label for="email">{{ __('Email') }}</label>
                <input type="email" id="email"
                       wire:model="email" @class(['form-control is-invalid' => $errors->has('email')])>
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </fieldset>
        @endguest

        <fieldset class="box fieldset">
            <label for="phone">{{ __('Phone Number') }}</label>
            <input type="tel" id="phone" wire:model="phone"
                   required @class(['form-control is-invalid' => $errors->has('phone')])>
            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
        </fieldset>

        @guest
            <div class="box grid-2">
                <fieldset class="fieldset">
                    <label for="password">{{ __('Password') }}</label>
                    <input type="password" id="password"
                           wire:model="password" @class(['form-control is-invalid' => $errors->has('password')])>
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </fieldset>

                <fieldset class="fieldset">
                    <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                    <input type="password" id="password_confirmation" wire:model="password_confirmation">
                </fieldset>
            </div>
        @endguest

        <fieldset class="box fieldset">
            <label for="city">{{ __('City') }}</label>
            <input type="text" id="city" wire:model="city"
                   required @class(['form-control is-invalid' => $errors->has('city')])>
            @error('city') <span class="text-danger">{{ $message }}</span> @enderror
        </fieldset>

        <fieldset class="box fieldset">
            <label for="address">{{ __('Address') }}</label>
            <input type="text" id="address" wire:model="address"
                   required @class(['form-control is-invalid' => $errors->has('address')])>
        </fieldset>
    @endif

    <fieldset class="box fieldset">
        <label for="note">{{ __('Order notes') }} ({{ __('optional') }})</label>
        <textarea name="note" id="note" cols="2" rows="2" wire:model="note"></textarea>
    </fieldset>
</div>
