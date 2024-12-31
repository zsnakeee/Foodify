<?php

namespace App\Services\Product;

class Cart extends Storage
{
    protected string $key = 'wishlist';
    protected string $driver = 'session';

    public function add(\App\Models\Product $product, int $quantity = 1): void
    {
        match ($this->driver) {
            'database' => $this->addUsingDatabase($product, $quantity),
            'session' => $this->addUsingSession($product, $quantity),
        };
    }

    public function all(): array
    {
        return match ($this->driver) {
            'database' => auth()->user()->{$this->key}()->toArray(),
            'session' => session($this->key, []),
            default => [],
        };
    }

    public function has(\App\Models\Product $product): bool
    {
        return match ($this->driver) {
            'database' => auth()->user()->{$this->key}()->where('product_id', $product->id)->exists(),
            'session' => in_array($product->id, session($this->key, [])[$product->id] ?? []),
            default => false,
        };
    }

    public function count(\App\Models\Product $product): int
    {
        return match ($this->driver) {
            'database' => auth()->user()->{$this->key}()
                ->where('product_id', $product->id)
                ->count(),
            'session' => count(session($this->key, [])[$product->id] ?? []),
            default => 0,
        };
    }

    public function remove(\App\Models\Product $product): void
    {
        match ($this->driver) {
            'database' => $this->removeUsingDatabase($product),
            'session' => $this->removeUsingSession($product),
        };
    }

    public function migrate(): void
    {
        $items = session($this->key, []);
        if (auth()->check() && count($items) > 0) {
            $currentItems = auth()->user()->{$this->key}()->pluck('product_id')->toArray();
            $matched = array_intersect(array_keys($items), $currentItems);

            auth()->user()->{$this->key}()->whereIn('product_id', $matched)->delete();

            foreach ($items as $cart) {
                auth()->user()->{$this->key}()->create(['product_id' => $cart['product_id'], 'quantity' => $cart['quantity']]);
            }

            session()->forget($this->key);
        }
    }

    protected function addUsingSession(\App\Models\Product $product, int $quantity = 1): void
    {
        $items = session($this->key, []);
        if (isset($items[$product->id]))
            $items[$product->id]['quantity'] = $quantity;
        else
            $items[$product->id] = ['product_id' => $product->id, 'quantity' => $quantity];

        if ($items[$product->id]['quantity'] <= 0)
            unset($items[$product->id]);

        session([$this->key => $items]);
    }


    protected function removeUsingSession(\App\Models\Product $product): void
    {
        $items = session($this->key, []);
        unset($items[$product->id]);
        session([$this->key => $items]);
    }

    protected function getFromSession(int $limit): array
    {
        return array_keys(array_reverse(array_slice(session($this->key, []), -$limit, $limit)));
    }

    protected function addUsingDatabase(\App\Models\Product $product, int $quantity = 1): void
    {
        $cart = auth()->user()->{$this->key}()->updateOrCreate(['product_id' => $product->id], ['quantity' => $quantity]);
        if ($quantity <= 0)
            $cart->delete();
    }

    protected function removeUsingDatabase(\App\Models\Product $product): void
    {
        auth()->user()->{$this->key}()->where('product_id', $product->id)->delete();
    }

    protected function getFromDatabase(int $limit): array
    {
        return auth()->user()
            ->{$this->key}()
            ->latest()
            ->limit($limit)
            ->get()
            ->toArray();
    }
}

