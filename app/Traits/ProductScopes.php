<?php

namespace App\Traits;

trait ProductScopes
{
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    public function scopeNew($query)
    {
        return $query->where('is_new', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeBest($query)
    {
        return $query->where('is_best', true);
    }

    public function scopeHot($query)
    {
        return $query->where('is_hot', true);
    }

    public function scopeDiscounted($query)
    {
        return $query->whereHas('discounts', function ($query) {
            $query->orderBy('discount', 'desc');
        });
    }

    public function scopeInStock($query)
    {
        return $query->where('quantity', '>', 0);
    }

    public function scopeOutOfStock($query)
    {
        return $query->where('quantity', 0);
    }

    public function scopeFilter($query, $filters)
    {
        return $query
            ->when($filters['category'], fn ($q, $category) => $q->where('category_id', $category))
            ->when($filters['brand'], fn ($q, $brand) => $q->where('brand_id', $brand))
            ->when($filters['priceRange'], fn ($q, $priceRange) => $q->whereBetween('price', $priceRange))
            ->when($filters['availability'], fn ($q, $availability) => $q->where('quantity', $availability === 'in_stock' ? '>' : '=', 0));
    }
}
