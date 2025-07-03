<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach($this->datas() as $key=>$value)
        {
            Role::create($value);
        }
    }

    private function datas()
    {
        return [
            [
                'name'=>'Admin'
            ],
            [
               'name'=>'Vendor'
            ],
            [
                'name'=>'Delivery Man'
             ],



        ];
    }
}
