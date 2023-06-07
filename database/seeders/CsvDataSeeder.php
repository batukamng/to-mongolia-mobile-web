<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CsvDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CsvProvinceSeeder::class);
        $this->call(CsvLocationSeeder::class);
        $this->call(CsvRestaurantSeeder::class);
        $this->call(CsvHotelSeeder::class);
    }
}
