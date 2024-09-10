<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductFilter extends QueryFilters
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function ingredient($term):Builder
    {
        return $this->builder->whereHas('ingredients', function($query) use ($term){
            $filter = new IngredientFilter($this->request);
           $query->filter($filter);
        });
    }

}
