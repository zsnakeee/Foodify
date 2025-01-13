<div>
    <section class="flat-spacing-11">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <livewire:frontend.components.profile-navtab tab="profile"/>
                </div>

                <div class="col-lg-9">
                    {{--                    <div class="d">--}}
                    {{--                        <div class="d-flex justify-content-between">--}}
                    {{--                            <h6 class="fw-5">{{ __('Profile') }}</h6>--}}
                    {{--                            <button class="tf-btn bg-primary text-white animate-hover-btn justify-content-center"--}}
                    {{--                                    wire:click="update">{{ __('Update') }}</button>--}}
                    {{--                        </div>--}}
                    {{--                        <hr class="mt-3 mb-3" style="border-top: 1px dashed var(--line); opacity: 1;"/>--}}
                    {{--                    </div>--}}

                    <div class=".">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <h6 class="fw-5 mb_20">{{ __('Personal Information') }}</h6>

                                <x-form.input wire:model="name" name="name" class="w-100"
                                              value="{{ $user->name }}"/>
                                <x-form.input name="email" class="w-100"
                                              value="{{ $user->email }}" disabled/>
                                <x-form.input name="phone" class="w-100"
                                              value="{{ $user->phone }}" disabled/>

                                <button class="tf-btn bg-primary text-white animate-hover-btn justify-content-center"
                                        wire:click="update">{{ __('Update') }}</button>
                            </div>

                            <div class="col-12 col-md-6 mt-4 mt-md-0">
                                <h6 class="fw-5 mb_20">{{ __('Change Password') }}</h6>
                                <x-form.input wire:model="current_password" name="current_password" type="password"
                                              label="{{ __('Current Password') }}"
                                              class="w-100"/>
                                <x-form.input wire:model="new_password" name="new_password" type="password"
                                              class="w-100"
                                              label="{{ __('New Password') }}"/>
                                <x-form.input wire:model="new_password_confirmation" name="new_password_confirmation"
                                              type="password"
                                              label="{{ __('Confirm New Password') }}"
                                              class="w-100"/>

                                <button class="tf-btn bg-primary text-white animate-hover-btn justify-content-center"
                                        wire:click="updatePassword">{{ __('Update Password') }}</button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
    </section>
</div>
