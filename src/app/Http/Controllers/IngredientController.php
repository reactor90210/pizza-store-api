<?php

namespace App\Http\Controllers;

use App\Http\Resources\IngredientCollection;
use App\Repositories\Interfaces\IngredientRepositoryInterface;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    private IngredientRepositoryInterface $ingredientRepository;

    public function __construct(IngredientRepositoryInterface $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    public function getIngredients():IngredientCollection
    {
        return new IngredientCollection($this->ingredientRepository->getIngredients());
    }
}
