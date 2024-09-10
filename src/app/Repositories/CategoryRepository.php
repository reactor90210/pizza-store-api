<?php

namespace App\Repositories;

use App\Filters\ProductFilter;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Filters\ProductItemFilter;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getCategories(ProductItemFilter $productItemFilter, ProductFilter $productFilter):Collection
    {
        return Category::with(['products.productItems'])
            ->withWhereHas('products' , function($query) use ($productItemFilter, $productFilter){
                $query->whereHas('productItems', function($itemQuery) use ($productItemFilter){
                    $itemQuery->filter($productItemFilter);
                });
                $query->filter($productFilter);
        })->get();
    }
}
