<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Media\Models\MediaFile;
use Modules\Location\Models\Location;

class LocationShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert location category
        $cashmereCatId = DB::table('location_category')->insertGetId([
            'name'       => 'Shop > Cashmere',
            'icon_class' => '',
            'status'     => 'publish'
        ]);

        // Create locations
        foreach ($this->cashmereLocations() as $key => $location) {
            $locationModel = new Location($location);
            $locationModel->category_id = $cashmereCatId;
            $locationModel->save();
        }

        // --------------------------------------------

        // Insert location category
        $depStoreCatId = DB::table('location_category')->insertGetId([
            'name'       => 'Shop > Department Store',
            'icon_class' => '',
            'status'     => 'publish'
        ]);

        // Create locations
        foreach ($this->departmentLocations() as $key => $location) {
            $locationModel = new Location($location);
            $locationModel->category_id = $depStoreCatId;
            $locationModel->save();
        }

        // --------------------------------------------

        // Insert location category
        $luxuryCatId = DB::table('location_category')->insertGetId([
            'name'       => 'Shop > Luxury Brand',
            'icon_class' => '',
            'status'     => 'publish'
        ]);

        // Create locations
        foreach ($this->luxuryLocations() as $key => $location) {
            $locationModel = new Location($location);
            $locationModel->category_id = $luxuryCatId;
            $locationModel->save();
        }

        // --------------------------------------------

        // Insert location category
        $accessoryCatId = DB::table('location_category')->insertGetId([
            'name'       => 'Shop > Accessory',
            'icon_class' => '',
            'status'     => 'publish'
        ]);

        // Create locations
        foreach ($this->accessoryLocations() as $key => $location) {
            $locationModel = new Location($location);
            $locationModel->category_id = $accessoryCatId;
            $locationModel->save();
        }
    }

    private function cashmereLocations(): array
    {
        $tips_shop_cashmere = MediaFile::findMediaByName("tips_shop_cashmere")->id;

        return [
            [
                'name' => 'Gobi',
                'content' => '<p>Gobi cashmere is a Mongolian cashmere brand that supplies 100% cashmere, camel wool, and yak down products in both as Gobi brand and private label to nearly 150 customers in more than 30 countries around the world.</p>',
                'image_id' => $tips_shop_cashmere,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'SOR Cashmere',
                'content' => '<p>SOR Cashmere factory building 20th khoroo, Bayangol district, Ulaanbaatar, Mongolia.</p>',
                'image_id' => $tips_shop_cashmere,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Mongolian Gallery Cashmere Shop',
                'content' => '<p>Sustainable, organic cashmere, leather and wool products made by Mongolian top small, medium and women-owned businesses.</p>',
                'image_id' => $tips_shop_cashmere,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        ];
    }

    private function departmentLocations(): array
    {
        $tips_shop_department_store = MediaFile::findMediaByName("tips_shop_department_store")->id;

        return [
            [
                'name' => 'The State Department Store',
                'content' => '<p>Known as ikh delguur (big shop), is a modern shopping center that’s the largest and reportedly the most luxurious store in Mongolia.</p>',
                'image_id' => $tips_shop_department_store,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Nomin Department Store',
                'content' => '<p>Popular department store chain in Mongolia that offers a wide range of products including clothing, electronics, and groceries.</p>',
                'image_id' => $tips_shop_department_store,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Misheel Mega Mall',
                'content' => '<p>One of the largest shopping centers in Ulaanbaatar that offers a wide range of products including clothing, electronics, and groceries.</p>',
                'image_id' => $tips_shop_department_store,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Polaris Department Store',
                'content' => '<p>Department store chain that offers a wide range of products including clothing, electronics, and groceries.</p>',
                'image_id' => $tips_shop_department_store,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Naran Mall',
                'content' => '<p>Prime location for a wide range of high-end shopping stores, premium dining, unique coffee shops, and entertainment.</p>',
                'image_id' => $tips_shop_department_store,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        ];
    }

    private function luxuryLocations(): array
    {
        $tips_shop_luxury_brand = MediaFile::findMediaByName("tips_shop_luxury_brand")->id;

        return [
            [
                'name' => 'Mongol',
                'content' => '<p>a fashion brand that combines traditional Mongolian designs with modern styles.</p>',
                'image_id' => $tips_shop_luxury_brand,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Mode 350K',
                'content' => '<p>a fashion brand that creates unique and stylish clothing for both men and women.</p>',
                'image_id' => $tips_shop_luxury_brand,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Michel & Amazonka',
                'content' => '<p>a fashion brand that specializes in creating high-quality leather bags and accessories.</p>',
                'image_id' => $tips_shop_luxury_brand,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Choice',
                'content' => '<p>a fashion brand that creates clothing for both men and women with a focus on sustainability.</p>',
                'image_id' => $tips_shop_luxury_brand,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Eza',
                'content' => '<p>a fashion brand that creates unique and stylish clothing for both men and women.</p>',
                'image_id' => $tips_shop_luxury_brand,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Futuristic Type',
                'content' => '<p>a fashion brand that creates unique and stylish clothing for both men and women.</p>',
                'image_id' => $tips_shop_luxury_brand,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        ];
    }

    private function accessoryLocations(): array
    {
        $tips_shop_accessories = MediaFile::findMediaByName("tips_shop_accessories")->id;

        return [
            [
                'name' => 'Naadam Center',
                'content' => '<p>a shopping mall that features a variety of shops and restaurants.</p>',
                'image_id' => $tips_shop_accessories,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'ART Mongolia',
                'content' => '<p>a store that sells traditional Mongolian art and crafts.</p>',
                'image_id' => $tips_shop_accessories,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'State Department Store',
                'content' => '<p>a large department store that sells clothing, electronics, and other items.</p>',
                'image_id' => $tips_shop_accessories,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        ];
    }
}
