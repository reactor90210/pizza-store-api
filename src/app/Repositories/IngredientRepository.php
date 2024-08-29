<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IngredientRepositoryInterface;
use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Collection;

class IngredientRepository implements IngredientRepositoryInterface
{
    public function getIngredients():Collection
    {
        return Ingredient::all();
    }
}
