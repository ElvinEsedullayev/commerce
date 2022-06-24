<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productSeeder = [
            ['id' => 1,'category_id' => 5,'section_id' => 1,'product_name' => 'Casual T-shirts', 'product_code' => 'CC-1233', 'product_price' => 100, 'product_color' => 'Red', 'product_discount' => 10, 'product_weight' => '200', 'product_video' => '', 'product_image' => '', 'description' => 'Casual t-shirt', 'wash_care' => '', 'fabric' => '', 'pattern' => '', 'sleeve' => '', 'fit' => '', 'occasion' => '', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'status' => 1],
            ['id' => 2,'category_id' => 5,'section_id' => 1,'product_name' => 'Sport T-shirts', 'product_code' => 'CC-1244', 'product_price' => 200, 'product_color' => 'Black', 'product_discount' => 20, 'product_weight' => '500', 'product_video' => '', 'product_image' => '', 'description' => 'sport t-shirt', 'wash_care' => '', 'fabric' => '', 'pattern' => '', 'sleeve' => '', 'fit' => '', 'occasion' => '', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'status' => 1],
        ];
        Product::insert($productSeeder);
    }
}
