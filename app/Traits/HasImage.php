<?php

namespace App\Traits;

use Storage;

trait HasImage
{
    public function getImageUrlAttribute(): string
    {
        return $this->getImageUrl($this->image);
    }

    public function getGalleryUrlsAttribute(): array
    {
        return array_map(fn ($image) => $this->getImageUrl($image), $this->gallery ?? []);
    }

    protected function getImageUrl($image): string
    {
        $isUrl = filter_var($image, FILTER_VALIDATE_URL);
        if ($isUrl) {
            return $image;
        }

        if (Storage::disk('public')->exists($image)) {
            return Storage::url($image);
        }

        return '';
    }
}
