<?php

namespace App\Models;

use App\Traits\HasImage;
use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasImage;
    use HasTranslations;

    protected $fillable = [
        'title',
        'body',
        'button_text',
        'image',
        'url',
        'is_active',
        'order',
    ];

    public array $translatable = [
        'title',
        'body',
        'button_text',
    ];

    public static function boot(): void
    {
        parent::boot();
        static::creating(function ($element) {
            $biggestOrder = Banner::max('order');
            $element->order = $biggestOrder + 1;
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
