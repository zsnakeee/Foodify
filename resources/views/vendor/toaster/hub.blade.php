<div role="status" id="toaster" x-data="toasterHub(@js($toasts), @js($config))"
     style="z-index: 9999999999999999  !important;"
    @class([
    'position-fixed p-4 w-100 d-flex flex-column pe-none',
    'bottom-0' => $alignment->is('bottom'),
    'top-50 translate-middle-y' => $alignment->is('middle'),
    'top-0' => $alignment->is('top'),
    'align-items-start rtl:items-end' => $position->is('left'),
    'align-items-center' => $position->is('center'),
    'align-items-end rtl:items-start' => $position->is('right'),
 ])>
    <template x-for="toast in toasts" :key="toast.id">
        <div x-show="toast.isVisible"
             x-init="$nextTick(() => toast.show($el))"
             @if($alignment->is('bottom'))
                 x-transition:enter-start="translate-y-12 opacity-0"
             x-transition:enter-end="translate-y-0 opacity-100"
             @elseif($alignment->is('top'))
                 x-transition:enter-start="-translate-y-12 opacity-0"
             x-transition:enter-end="translate-y-0 opacity-100"
             @else
                 x-transition:enter-start="opacity-0 scale-90"
             x-transition:enter-end="opacity-100 scale-100"
             @endif
             x-transition:leave-end="opacity-0 scale-90"
             @class(['position-relative w-100 pe-auto', 'text-center' => $position->is('center')])
             style="max-width: 20rem; transition: all 0.3s ease-in-out !important"

        >
            <div class="toast align-items-center d-inline-block mb-2" role="alert" aria-live="assertive"
                 :class="toast.select({ error: 'bg-danger', info: 'bg-secondary', success: 'bg-primary', warning: 'bg-warning' })"
                 aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body"
                         :class="toast.select({ error: 'text-white', info: 'text-white', success: 'text-white', warning: 'text-white' })">
                        <i class="me-2 fa-solid"
                           :class="toast.select({ error: 'fa-circle-exclamation',  info: 'fa-circle-info', success: 'fa-circle-check', warning: 'fa-triangle-exclamation'})"></i>
                        <span x-text="toast.message"></span>
                    </div>
                    @if($closeable)
                        <button type="button" @click="toast.dispose()"
                                class="btn-close me-2 m-auto"
                                data-bs-dismiss="toast" aria-label="Close"></button>
                    @endif
                </div>
            </div>
        </div>
    </template>
</div>
