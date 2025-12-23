<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Http\Resources\ProductCollection;
use Illuminate\Http\Request;
use App\Http\Resources\Api\ApiResponse;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function getBySlug($slug): ApiResponse
    {
        $product = $this->productRepository->getBySlug($slug);

        if (is_null($product)) {
            new ApiResponse(null, 404);
        }

        return new ApiResponse(new ProductResource($product));
    }
    public function getRecommended(): ApiResponse
    {
        return new ApiResponse(new ProductCollection($this->productRepository->getRecommended()));
    }
    public function getSearch(Request $request): ApiResponse
    {
        return new ApiResponse(new ProductCollection($this->productRepository->getSearch($request->input('query'))));
    }
}
