<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductsAttribute;
class ProductAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productsAttributeSeeder = [
            ['id' => 1,'product_id' =>1,'size'=>'Small','price'=>1000,'stock'=>10,'sku'=>'BC001-s','status'=>1],
            ['id' => 2,'product_id' =>1,'size'=>'Medium','price'=>1200,'stock'=>5,'sku'=>'BC001-m','status'=>1],
            ['id' => 3,'product_id' =>1,'size'=>'Large','price'=>1500,'stock'=>50,'sku'=>'BC001-l','status'=>1],
        ];
        ProductsAttribute::insert($productsAttributeSeeder);
    }
}
