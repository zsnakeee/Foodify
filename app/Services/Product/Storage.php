<?php

namespace App\Services\Product;

use App\Models\Product;

abstract class Storage
{
    protected string $key;
    protected string $driver;

    public function add(Product $product): void
    {
        match ($this->driver) {
            'database' => $this->addUsingDatabase($product),
            'session' => $this->addUsingSession($product),
        };
    }

    public function get(int $limit = 5): array
    {
        return match ($this->driver) {
            'database' => $this->getFromDatabase($limit),
            'session' => $this->getFromSession($limit),
        };
    }

    public function has(Product $product): bool
    {
        return match ($this->driver) {
            'database' => auth()->user()->{$this->key}()->where('product_id', $product->id)->exists(),
            'session' => in_array($product->id, session($this->key, [])),
            default => false,
        };
    }

    public function count(Product $product): int
    {
        return match ($this->driver) {
            'database' => auth()->user()->{$this->key}()
                ->where('product_id', $product->id)
                ->count(),
            'session' => count(session($this->key, [])),
            default => 0,
        };
    }

    public function remove(Product $product): void
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
            $matched = array_intersect($items, $currentItems);

            auth()->user()->{$this->key}()->whereIn('product_id', $matched)->delete();

            foreach ($items as $productId) {
                auth()->user()->{$this->key}()->create(['product_id' => $productId]);
            }

            session()->forget($this->key);
        }
    }

    protected function getFromDatabase(int $limit): array
    {
        return auth()->user()
            ->{$this->key}()
            ->latest()
            ->limit($limit)
            ->pluck('product_id')
            ->toArray();
    }

    protected function getFromSession(int $limit): array
    {
        return array_reverse(array_slice(session($this->key, []), -$limit, $limit));
    }

    protected function addUsingDatabase(Product $product): void
    {
        if (!auth()->user()->{$this->key}()->where('product_id', $product->id)->exists()) {
            auth()->user()->{$this->key}()->create(['product_id' => $product->id]);
        }
    }

    protected function addUsingSession(Product $product): void
    {
        $items = session($this->key, []);
        if (!in_array($product->id, $items)) {
            $items[] = $product->id;
            session([$this->key => $items]);
        }
    }

    protected function removeUsingDatabase(Product $product): void
    {
        auth()->user()->{$this->key}()->where('product_id', $product->id)->delete();
    }

    protected function removeUsingSession(Product $product): void
    {
        $items = session($this->key, []);
        if (($key = array_search($product->id, $items)) !== false) {
            unset($items[$key]);
            session([$this->key => $items]);
        }
    }
}
