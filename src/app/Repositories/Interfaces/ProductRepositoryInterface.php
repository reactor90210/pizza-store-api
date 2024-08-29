<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    public function getBySlug($slug);
    public function getRecommended();
    public function getSearch($search);
}
