<?php

namespace App\Http\Controllers;

use App\Filters\ProductFilter;
use App\Filters\ProductItemFilter;
use App\Http\Resources\CategoryCollection;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryController extends Controller
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategories(ProductItemFilter $productItemFilter, ProductFilter $productFilter):ResourceCollection
    {
        return new CategoryCollection($this->categoryRepository->getCategories($productItemFilter, $productFilter));
    }
}
