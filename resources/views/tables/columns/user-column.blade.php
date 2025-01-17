<div class="flex items-center gap-2 w-auto">
    <img src="{{ $getState()->avatar }}" class="w-8 h-8 rounded-full max-w-none" alt="{{ $getState()->name }}">
    <div>
        <div class="text-sm font-medium text-gray-900 flex items-center gap-2" style="line-height: unset">
            <span class="order-2">{{ $getState()->name }}</span>
            @if($redirectOnClick)
                <a href="{{ \App\Filament\Resources\UserResource::getRoutePrefix() . '/' . $getState()->getRouteKey() }}"
                   class="font-medium text-gray-900 hover:text-blue-600 order-1">
                    <x-heroicon-s-arrow-top-right-on-square class="w-4 h-4 inline-block"/>
                </a>
            @endif
        </div>
        <div class="text-sm text-gray-500">{{ $getState()->email }}</div>
    </div>
</div>
