<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class IngredientFilter extends QueryFilters
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function ingredient($term):Builder
    {
        return $this->builder->whereIn('id', explode(',', $term));
    }
}
