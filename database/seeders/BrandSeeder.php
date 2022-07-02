<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;
class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandSeeder = [
            ['id' => 1, 'name' => 'Arrow', 'status' => 1],
            ['id' => 2, 'name' => 'Gap', 'status' => 1],
            ['id' => 3, 'name' => 'Lee', 'status' => 1],
            ['id' => 4, 'name' => 'Samsung', 'status' => 1],
            ['id' => 5, 'name' => 'LG', 'status' => 1],
            ['id' => 6, 'name' => 'Lenova', 'status' => 1],
            ['id' => 7, 'name' => 'Mi', 'status' => 1],
        ];
        Brand::insert($brandSeeder);
    }
}
