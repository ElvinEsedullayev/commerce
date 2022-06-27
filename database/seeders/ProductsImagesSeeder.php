<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductsImages;
class ProductsImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productsImagesSeeder = [
            ['id' =>1,'product_id'=>1,'image'=>'111.jpg','status'=>1]
        ];
        ProductsImages::insert($productsImagesSeeder);
    }
}
