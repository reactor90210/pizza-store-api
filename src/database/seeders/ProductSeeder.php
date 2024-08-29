<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Ingredient;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public Utils $utils;

    public function __construct()
    {
        $this->utils = new Utils();
    }

    public function run(): void
    {
        $json = File::get("database/seeders/json/products.json");
        $products = json_decode($json, true);
        $ingredients = Ingredient::all();

        foreach ($products as $product){
            $product['slug'] = Str::slug($this->utils->translit($product['name']));
            $imageSaved = $this->utils->saveImage($product['image'],  "/products/$product[slug].webp");

            if ($imageSaved){
                $product['image'] = "$product[slug].webp";
            }

            $created = Product::create($product);

            $ingredientsSliced = match ($created->name) {
                "Пепперони фреш" => $ingredients->slice(0, 5),
                "Сырная" => $ingredients->slice(5, 5),
                "Чоризо фреш" => $ingredients->slice(10, 10),
                default => false
            };

            if($ingredientsSliced){
                $created->ingredients()->attach($ingredientsSliced);
            }
        }
    }
}
