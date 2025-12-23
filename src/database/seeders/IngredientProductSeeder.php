<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Ingredient;

class IngredientProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Category::with('products')->where('name', 'pizza')->first();
        $ingredients = Ingredient::all();

        $offset = 0;
        $counts = [6, 6, 5];

        foreach ($category->products as $index => $product){
            $productIngredients = $ingredients->slice($offset, $counts[$index]);

            $product->ingredients()->sync(
                $productIngredients->pluck('id')->toArray()
            );

            $offset += $counts[$index];
        }
    }
}
