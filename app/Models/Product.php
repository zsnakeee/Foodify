<?php

namespace App\Models;

use App\Services\Cart\ExtendedCart;
use App\Traits\HasImage;
use App\Traits\HasTranslations;
use App\Traits\ProductScopes;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use HasFactory;

    use HasImage;
    use HasTranslations;
    use ProductScopes;

    protected $fillable = [
        'name',
        'code',
        'description',
        'slug',
        'image',
        'gallery',
        'quantity',
        'price',
        'is_active',
        'is_new',
        'is_featured',
        'is_best',
        'is_hot',
    ];

    protected $casts = [
        'gallery' => 'array',
    ];

    protected array $translatable = [
        'name',
        'description',
        'slug',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function discounts(): HasMany
    {
        return $this->hasMany(Discount::class);
    }

    public function dailyDeals(): HasMany
    {
        return $this->belongsToMany(DailyDeal::class, 'daily_deal_products')->withTimestamps();
    }

    protected function priceConverted(): Attribute
    {
        return Attribute::make(
            get: fn ($value, array $attributes) => exchange($attributes['price'], config('app.currency')),
        );
    }

    protected function priceFormatted(): Attribute
    {
        return Attribute::make(
            get: fn ($value, array $attributes) => format_price($attributes['price']),
        );
    }

    public function isWished(): bool
    {
        $wishlist = app(ExtendedCart::class)->wishlist();

        return $wishlist->has($this);
    }

    public function isCarted(): bool
    {
        $cart = app(ExtendedCart::class)->shopping();

        return $cart->has($this);
    }

    public function attributesForQuickView(): string
    {
        $attributes['url'] = route('products.view', $this->slug);
        $attributes['category_url'] = route('categories.view', $this->category->slug);
        $attributes['category'] = $this->category->name;
        $attributes['image_url'] = $this->image_url;
        $attributes['gallery_urls'] = $this->gallery_urls;
        $attributes['formatted_price'] = $this->price_formatted;
        $attributes['name'] = $this->name;
        $attributes['description'] = $this->description;
        $attributes['is_wished'] = $this->isWished();
        $attributes['is_carted'] = $this->isCarted();

        return json_encode($attributes);
    }
}
