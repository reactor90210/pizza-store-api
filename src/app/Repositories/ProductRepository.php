<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProductRepository implements ProductRepositoryInterface
{
    public function getBySlug($slug):Model
    {
        return Product::with(['ingredients', 'productItems'])->where('slug', $slug)->first();
    }

    public function getRecommended():Collection
    {
        return Product::with('productItems')
                        ->selectPrice()
                        ->inRandomOrder()
                        ->limit(4)
                        ->get();
    }

    public function getSearch($search):Collection
    {
        return Product::where('name', 'LIKE', "$search%")->limit(10)->get();
    }
}
