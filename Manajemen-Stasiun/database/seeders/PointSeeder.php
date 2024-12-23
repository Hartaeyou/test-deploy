<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('point')->insert([
            ['nama' => 'Manggarai', "longitude" => "106.8431604", "latitude" => "-6.2099022", 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Tanah Abang', "longitude" => "106.8108533", "latitude" => "-6.1856995", 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Duri', "longitude" => "106.7987967", "latitude" => "-6.1553011", 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Batu Ceper', "longitude" => "106.6622402", "latitude" => "-6.1720584", 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Bandara', "longitude" => "106.644124", "latitude" => "-6.121913", 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
