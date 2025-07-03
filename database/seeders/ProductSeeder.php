<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach($this->datas() as $key=>$value)
        {
            Product::create($value);
        }
    }

    private function datas()
    {
        return [
            [
                'image'=>'product/product1.png',
              'title'=>'Rainbow T-Shirts',
              'brand'=>'adidas',
              'price'=>78,
            ],
            [
                'image'=>'product/product2.png',
              'title'=>'Green T-Shirts',
              'brand'=>'adidas',
              'price'=>14,
            ],
            [
                'image'=>'product/product3.png',
              'title'=>'Multi T-Shirts',
              'brand'=>'adidas',
              'price'=>24,
            ],
            [
                'image'=>'product/product4.png',
              'title'=>'White T-Shirts',
              'brand'=>'adidas',
              'price'=>33,
            ],
            [
                'image'=>'product/product5.png',
              'title'=>'Blue T-Shirts',
              'brand'=>'adidas',
              'price'=>44,
            ],
            [
                'image'=>'product/product6.png',
              'title'=>'Double T-Shirts',
              'brand'=>'adidas',
              'price'=>55,
            ],
            [
                'image'=>'product/product7.png',
              'title'=>'Pant T-Shirts',
              'brand'=>'adidas',
              'price'=>44,
            ],
            [
                'image'=>'product/product8.png',
              'title'=>'Top T-Shirts',
              'brand'=>'adidas',
              'price'=>55,
            ],

        ];
    }
}
