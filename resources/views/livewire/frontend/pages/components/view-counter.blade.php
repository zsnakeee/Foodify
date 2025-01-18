<?php

use App\Events\ViewCounterUpdated;
use Livewire\Volt\Component;

new class extends Component {
    public int $count = 0;

    public string $counterKey;

    protected string $sessionKey;

    protected string $driver = 'database';

    protected int $expireTime = 120;

    public function mount(): void
    {
        $this->extendSession();
        broadcast(new ViewCounterUpdated($this->count))->toOthers();
    }

    public function extendSession(): void
    {
        $viewers = Cache::get($this->counterKey, []);
        $viewers[session()->getId()] = now()->addSeconds($this->expireTime)->timestamp;
        Cache::put($this->counterKey, $viewers);

        $this->cleanExpiredSessions();
        $this->count = count($viewers);
    }

    public function cleanExpiredSessions(): void
    {
        $viewers = Cache::get($this->counterKey, []); // Retrieve the current viewers list
        $viewers_cleaned = array_filter($viewers, fn($timestamp) => $timestamp > now()->timestamp);
        Cache::put($this->counterKey, $viewers_cleaned);

        if (count($viewers_cleaned) !== count($viewers)) {
            $this->count = count($viewers_cleaned);
            broadcast(new ViewCounterUpdated($this->count))->toOthers();
        }
    }

    public function cleanCurrentSession(): void
    {
        $viewers = Cache::get($this->counterKey, []); // Retrieve the current viewers list
        unset($viewers[session()->getId()]);
        Cache::put($this->counterKey, $viewers);

        $this->count = count($viewers);
        broadcast(new ViewCounterUpdated($this->count))->toOthers();
    }
} ?>


<div class="liveview-count" wire:poll.1s="extendSession"
     x-data="{ count: @entangle('count') }"
     x-init="window.Echo.channel('Product.View').listen('ViewCounterUpdated', (e) => count = e.views)">
    <span x-text="count"></span>
</div>

@push('js')
    <script>
        window.addEventListener('beforeunload', function (event) {
            @this.
            call('cleanCurrentSession');
        });
    </script>
@endpush
