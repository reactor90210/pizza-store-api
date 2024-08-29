<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductItemFilter extends QueryFilters
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function size($term):Builder
    {
        return $this->builder->whereIn('size', explode(',', $term));
    }

    public function ingredient($term):Builder
    {
        return $this->builder->whereIn('id', explode(',', $term));
    }

    public function type($term):Builder
    {
        return $this->builder->whereIn('pizza_type', explode(',', $term));
    }

    public function price($term):Builder
    {
        return $this->builder->whereBetween('price', explode(',', $term));
    }
}
