<?php

namespace App\Traits;

trait CategoryScopes
{
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    public function scopeTop($query)
    {
        return $query->whereHas('products', function ($query) {
            $query->where('is_featured', true);
        });
    }

    public function scopeDiscounted($query)
    {
        return $query->whereHas('products', function ($query) {
            $query->whereHas('discounts', function ($query) {
                $query->orderBy('discount', 'desc');
            });
        });
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%$search%")
            ->orWhere('description', 'like', "%$search%");
    }
}
