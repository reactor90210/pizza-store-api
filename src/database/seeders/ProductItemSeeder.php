<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductItem;

class ProductItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private function generateRandomNumber($min, $max) : int
    {
        return mt_rand(ceil($min/10) , floor($max/10))*10;
    }

    private function generateProductItem($product_id, $pizza_type = null, $size = null) : array
    {
       return ['product_id' =>  $product_id,
                'price'     =>  $this->generateRandomNumber(190, 500),
                'pizza_type'=>  $pizza_type,
                'size'      =>  $size];
    }

    private function getData(){
        return [
            //Пицца "Пепперони фреш"
            $this->generateProductItem(1, 1, 20),
            $this->generateProductItem( 1, 2,  30),
            $this->generateProductItem( 1, 2,40),

            //Пицца "Сырная"
            $this->generateProductItem(2, 1, 20),
            $this->generateProductItem( 2, 1,30),
            $this->generateProductItem(2, 1, 40),
            $this->generateProductItem( 2, 2,20),
            $this->generateProductItem(2, 2, 30),
            $this->generateProductItem(2, 2, 40),

            //Пицца "Чоризо фреш"
            $this->generateProductItem(3,1, 20),
            $this->generateProductItem(3,2, 30),
            $this->generateProductItem(3,2, 40),

            //Остальные продукты
            $this->generateProductItem(4),
            $this->generateProductItem(5),
            $this->generateProductItem(6),
            $this->generateProductItem(7),
            $this->generateProductItem(8),
            $this->generateProductItem(9),
            $this->generateProductItem(10),
            $this->generateProductItem(11),
            $this->generateProductItem(12),
            $this->generateProductItem(13),
            $this->generateProductItem(14),
            $this->generateProductItem(15),
            $this->generateProductItem(16),
            $this->generateProductItem(17),
            $this->generateProductItem(18),
            $this->generateProductItem(19),
            $this->generateProductItem(20),
        ];
    }

    public function run(): void
    {
        foreach ($this->getData() as $item){
            ProductItem::create($item);
        }
    }
}
