<?php

namespace App\Models;

use App\Enums\DiscountType;
use Illuminate\Database\Eloquent\Model;

class DailyDeal extends Model
{
    protected $fillable = [
        'name',
        'banner',
        'start_date',
        'end_date',
        'status',
        'discount',
        'discount_type',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'status' => 'boolean',
        'discount' => 'integer',
        'discount_type' => DiscountType::class,
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'daily_deal_products')->withTimestamps();
    }
}
