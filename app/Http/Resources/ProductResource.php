<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Storage;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->getTranslations('name'),
            'code' => $this->code,
            'category' => $this->category->getTranslations('name'),
            'brand' => $this->brand->name,
            'description' => $this->getTranslations('description'),
            'image' => asset($this->image_url),
            'gallery' => collect($this->gallery)->map(fn ($image) => asset(Storage::url($image))),
            'quantity' => $this->quantity,
            'price' => $this->price,
            'is_active' => $this->is_active,
            'is_new' => $this->is_new,
            'is_featured' => $this->is_featured,
            'is_best' => $this->is_best,
            'is_hot' => $this->is_hot,
            'created_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}
