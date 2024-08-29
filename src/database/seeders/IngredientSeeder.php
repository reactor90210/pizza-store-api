<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class IngredientSeeder extends Seeder
{
    public Utils $utils;

    public function __construct()
    {
        $this->utils = new Utils();
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/seeders/json/ingredients.json");
        $ingredients = json_decode($json, true);

        foreach ($ingredients as $ingredient){
            $slug = Str::slug($this->utils->translit($ingredient['name']));
            $imageSaved = $this->utils->saveImage($ingredient['image'],  "/ingredients/$slug.png");

            if ($imageSaved){
                $ingredient['image'] = "$slug.png";
            }

            Ingredient::create($ingredient);
        }
    }
}
