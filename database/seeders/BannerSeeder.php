<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Banner;
class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bannerSeeder = [
            ['id' => 1, 'banner_image' => '1.png', 'title' => '', 'alt' => '','link' => '', 'status' => 1],
            ['id' => 2, 'banner_image' => '2.png', 'title' => '', 'alt' => '','link' => '', 'status' => 1],
            ['id' => 3, 'banner_image' => '3.png', 'title' => '', 'alt' => '','link' => '', 'status' => 1],
        ];
        Banner::insert($bannerSeeder);
    }
}
