<?php

namespace App\Repositories\Interfaces;

use App\Filters\ProductFilter;
use App\Filters\ProductItemFilter;

interface CategoryRepositoryInterface
{
    public function getCategories(ProductItemFilter $filters, ProductFilter $productFilter);
}
