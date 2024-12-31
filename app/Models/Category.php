<?php

namespace App\Models;

use App\Traits\CategoryScopes;
use App\Traits\HasImage;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;


class Category extends Model
{
    /** @use HasFactory<CategoryFactory> */
    use HasFactory;
    use HasImage;
    use HasTranslations;
    use CategoryScopes;


    protected $fillable = [
        'name',
        'description',
        'slug',
        'image',
        'is_active'
    ];

    public array $translatable = ['name', 'description', 'slug'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
