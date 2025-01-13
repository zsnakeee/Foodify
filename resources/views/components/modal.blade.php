@props(['name' => '', 'close' => true, 'centered' => false])

<div x-data="{ show: @entangle($attributes->wire('model')),
        close() {
            this.show = false
        }
     }"
     x-show="show">
    <div class="modal-backdrop" x-show="show"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
    </div>

    <div class="modal" :style="{ display: show ? 'block' : 'none' }">
        <div class="modal-dialog @if($centered) modal-dialog-centered @endif"
             x-on:click.away="close">

            <div class="modal-content"
                 x-show="show"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
            >
                <div class="modal-header d-flex justify-content-around align-items-center gap-2">
                    <h6 class="fs-18 modal-title">{{ $name }}</h6>
                    <button type="button" class="btn-close" @click="close"></button>
                </div>
                <div class="modal-body py-1">
                    {{ $slot }}
                </div>

                @isset($footer)
                    <div class="modal-footer">
                        @isset($close)
                            <button type="button" class="tf-btn btn-outline animate-hover-btn justify-content-center"
                                    @click="close">{{ __('Close') }}</button>
                        @endisset

                        {{ $footer }}
                    </div>
                @endisset
            </div>
        </div>
    </div>
</div>
