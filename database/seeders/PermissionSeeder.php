<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::insert([
            [
                'name'=>'Dashboard',
                'slug'=>'Dashboard',
                'groupby'=>0,
            ],
            [
                'name'=>'User',
                'slug'=>'User',
                'groupby'=>1,
            ],
            [
                'name'=>'Add User',
                'slug'=>'Add User',
                'groupBy'=>1,
            ],
            [
                'name'=>'Edit User',
                'slug'=>'Edit User',
                'groupBy'=>1,
            ],
            [
                'name'=>'Delete User',
                'slug'=>'Delete User',
                'groupBy'=>1,
            ],
            [
                'name'=>'Role',
                'slug'=>'Role',
                'groupBy'=>2,
            ],
            [
                'name'=>'Add Role',
                'slug'=>'Add Role',
                'groupBy'=>2,
            ],
            [
                'name'=>'Edit Role',
                'slug'=>'Edit Role',
                'groupBy'=>2,
            ],
            [
                'name'=>'Delete Role',
                'slug'=>'Delete Role',
                'groupBy'=>2,
            ],
            [
                'name'=>'Slider',
                'slug'=>'Slider',
                'groupBy'=>3,
            ],
            [
                'name'=>'Add Slider',
                'slug'=>'Add Slider',
                'groupBy'=>3,
            ],
            [
                'name'=>'Edit Slider',
                'slug'=>'Edit Slider',
                'groupBy'=>3,
            ],
            [
                'name'=>'Delete Slider',
                'slug'=>'Delete Slider',
                'groupBy'=>3,
            ],
            [
                'name'=>'Product',
                'slug'=>'Product',
                'groupBy'=>4,
            ],
            [
                'name'=>'Add Product',
                'slug'=>'Add Product',
                'groupBy'=>4,
            ],
            [
                'name'=>'Edit Product',
                'slug'=>'Edit Product',
                'groupBy'=>4,
            ],
            [
                'name'=>'Delete Product',
                'slug'=>'Delete Product',
                'groupBy'=>4,
            ],

            [
                'name'=>'Order',
                'slug'=>'Order',
                'groupBy'=>5,
            ],
            [
                'name'=>'Add Order',
                'slug'=>'Add Order',
                'groupBy'=>5,
            ],
            [
                'name'=>'Edit Order',
                'slug'=>'Edit Order',
                'groupBy'=>5,
            ],
            [
                'name'=>'Delete Order',
                'slug'=>'Delete Order',
                'groupBy'=>5,
            ],




        ]);
    }
}
