<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LocationShopSeeder::class);
        $this->call(LocationBeautySeeder::class);
    }
}
