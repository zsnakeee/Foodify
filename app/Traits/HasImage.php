<?php

namespace App\Traits;

use Storage;

trait HasImage
{
    public function getImageUrlAttribute(): string
    {
        return str_starts_with($this->image, 'http') ? $this->image : Storage::url($this->image);
    }

    public function getGalleryUrlsAttribute(): array
    {
        return array_map(fn ($image) => str_starts_with($image, 'http') ? $image : Storage::url($image), $this->gallery ?? []);
    }
}
