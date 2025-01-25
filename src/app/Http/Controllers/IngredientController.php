<?php

namespace App\Http\Controllers;

use App\Http\Resources\IngredientCollection;
use App\Repositories\Interfaces\IngredientRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Resources\Api\ApiResponse;

class IngredientController extends Controller
{
    private IngredientRepositoryInterface $ingredientRepository;

    public function __construct(IngredientRepositoryInterface $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    public function getIngredients(): ApiResponse
    {
        return new ApiResponse(new IngredientCollection($this->ingredientRepository->getIngredients()));
    }
}
