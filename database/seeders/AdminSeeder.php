<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminSeeder = [
            ['id' => 1,'name' => 'admin','type' => 'admin','mobile' => '0554966356','email' => 'admin@gmail.com','password' => Hash::make(12345678),'image' => '','status' => 1,'created_at' => Now(),'updated_at' => Now()],
            ['id' => 2,'name' => 'admin','type' => 'subadmin','mobile' => '0554966357','email' => 'elvin@gmail.com','password' => Hash::make(12345678),'image' => '','status' => 1,'created_at' => Now(),'updated_at' => Now()],
            ['id' => 3,'name' => 'admin','type' => 'subadmin','mobile' => '0554966358','email' => 'subadmin@gmail.com','password' => Hash::make(12345678),'image' => '','status' => 1,'created_at' => Now(),'updated_at' => Now()],
            ['id' => 4,'name' => 'admin','type' => 'subadmin','mobile' => '0554966359','email' => 'vendor@gmail.com','password' => Hash::make(12345678),'image' => '','status' => 1,'created_at' => Now(),'updated_at' => Now()],
        ];

        Admin::insert($adminSeeder);
    }
}
