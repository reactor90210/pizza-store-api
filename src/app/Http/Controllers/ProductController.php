<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Http\Resources\ProductCollection;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function getBySlug($slug):ProductResource
    {
        return new ProductResource($this->productRepository->getBySlug($slug));
    }
    public function getRecommended():ProductCollection
    {
        return new ProductCollection($this->productRepository->getRecommended());
    }
    public function getSearch(Request $request):ProductCollection
    {
        return new ProductCollection($this->productRepository->getSearch($request->input('query')));
    }
}
