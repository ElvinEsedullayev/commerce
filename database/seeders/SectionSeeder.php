<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Section;
class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectionSeeder = [
            ['id' => 1, 'name' => 'Men', 'status' => 1],
            ['id' => 2, 'name' => 'Women', 'status' => 1],
            ['id' => 3, 'name' => 'Kids', 'status' => 1],
        ];
        Section::insert($sectionSeeder);
    }
}
