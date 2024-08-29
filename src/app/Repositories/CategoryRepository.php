<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Filters\ProductItemFilter;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getCategories(ProductItemFilter $filters):Collection
    {
        return Category::with(['products.productItems'])->withWhereHas('products' , function($query) use ($filters){
            $query->whereHas('productItems', function($itemQuery) use ($filters){
                $itemQuery->filter($filters);
            });
        })->get();
    }
}
