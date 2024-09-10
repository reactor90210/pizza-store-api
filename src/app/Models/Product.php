<?php

namespace App\Models;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasFactory, Filterable;

    public function productItems(): HasMany
    {
        return $this->hasMany(ProductItem::class)->orderBy('price');
    }

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class);
    }

//    public function scopeSelectPrice(Builder $query):void
//    {
//         $query->addSelect(['price' =>
//            ProductItem::selectRaw('min(price)')
//                ->whereColumn('product_items.product_id', 'products.id')
//        ]);
//    }

}
