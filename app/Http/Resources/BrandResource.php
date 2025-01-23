<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
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
            'description' => $this->getTranslations('description'),
            'image' => asset($this->image_url),
            'products' => ProductResource::collection($this->whenLoaded('products')),
            'is_active' => $this->is_active,
            'created_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}
