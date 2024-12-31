<?php

namespace App\Traits;

use App\Models\Product;

trait StorageHandler
{
    protected string $key = 'wishlist';

    public function __construct()
    {
        match (auth()->check()) {
            true => $this->driver = 'database',
            false => $this->driver = 'session',
        };
    }

    public function add(Product $product): void
    {
        match ($this->driver) {
            'database' => $this->addUsingDatabase($product),
            'session' => $this->addUsingSession($product),
        };
    }

    public function get($limit = 5): array
    {
        return match ($this->driver) {
            'database' => $this->getFromDatabase($limit),
            'session' => $this->getFromSession($limit),
        };
    }

    public function has(Product $product): bool
    {
        return match ($this->driver) {
            'database' => auth()->user()->wishlist()->where('product_id', $product->id)->exists(),
            'session' => in_array($product->id, session('wishlist', [])),
            default => false,
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
        $key = $this->key;
        $wishlist = session($key, []);
        if (auth()->check() && count($wishlist) > 0) {
            $currentWishlist = auth()->user()->$key()->pluck('product_id')->toArray();
            $matched = array_intersect($wishlist, $currentWishlist);
            auth()->user()->$key()->whereIn('product_id', $matched)->delete();
            foreach ($wishlist as $productId) {
                auth()->user()->$key()->create(['product_id' => $productId]);
            }
        }
    }

    protected function getFromDatabase($limit): array
    {
        $key = $this->key;
        return auth()->user()->$key()->latest()->limit($limit)->get()->pluck('product_id')->toArray();
    }

    protected function getFromSession($limit): array
    {
        return array_reverse(array_slice(session($this->key, []), -$limit, $limit));
    }

    protected function addUsingDatabase(Product $product): void
    {
        $key = $this->key;
        if (auth()->user()->$key()->where('product_id', $product->id)->exists())
            return;

        auth()->user()->$key()->create(['product_id' => $product->id]);
    }

    protected function addUsingSession(Product $product): void
    {
        $wishlist = session($this->key, []);
        if (in_array($product->id, $wishlist))
            return;

        $wishlist[] = $product->id;
        session([$this->key => $wishlist]);
    }

    protected function removeUsingDatabase(Product $product): void
    {
        $key = $this->key;
        auth()->user()->$key()->where('product_id', $product->id)->delete();
    }

    protected function removeUsingSession(Product $product): void
    {
        $wishlist = session($this->key, []);
        $key = array_search($product->id, $wishlist);
        if ($key !== false) {
            unset($wishlist[$key]);
            session([$this->key => $wishlist]);
        }
    }
}
