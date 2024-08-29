<?php

namespace App\Repositories\Interfaces;

use App\Filters\ProductItemFilter;

interface CategoryRepositoryInterface
{
    public function getCategories(ProductItemFilter $filters);
}
