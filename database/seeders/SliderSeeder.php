<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach($this->datas() as $key=>$value)
        {
            Slider::create($value);
        }
    }

    private function datas()
    {
        return [
            [
              'heading'=>'Trade-in-offer',
              'title'=>'Super value deals',
              'title_two'=>'On all products',
              'subtitle'=>'Save more with coupons & up to 70% off!',
              'image'=>'slider/slider.png',
         
            ],

        ];
    }
}
