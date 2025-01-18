<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'is_active' => $this->is_active,
            'products' => ProductResource::collection($this->whenLoaded('products')),
            'created_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}
