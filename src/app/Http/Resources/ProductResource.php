<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'image' => $this->image,
            'price' =>  $this->whenHas('price'),
            'productItems' => ProductItemResource::collection($this->whenLoaded('productItems')),
//            'productItemDefault' => $this->whenLoaded('productItemsOrdered', function (){
//                return new ProductItemResource($this->productItemsOrdered->first());
//            }),
            'ingredients' => IngredientResource::collection($this->whenLoaded('ingredients'))
        ];
    }
}
