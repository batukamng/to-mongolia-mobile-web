<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Media\Models\MediaFile;
use Modules\Location\Models\Location;

class LocationBeautySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert location category
        $hairCatId = DB::table('location_category')->insertGetId([
            'name'       => 'Beauty > Hair',
            'icon_class' => '',
            'status'     => 'publish'
        ]);

        // Create locations
        foreach ($this->hairLocations() as $key => $location) {
            $locationModel = new Location($location);
            $locationModel->category_id = $hairCatId;
            $locationModel->save();
        }

        // --------------------------------------------

        $nailCatId = DB::table('location_category')->insertGetId([
            'name'       => 'Beauty > Nail',
            'icon_class' => '',
            'status'     => 'publish'
        ]);

        // Create locations
        foreach ($this->nailLocations() as $key => $location) {
            $locationModel = new Location($location);
            $locationModel->category_id = $nailCatId;
            $locationModel->save();
        }

        // --------------------------------------------

        $massageCatId = DB::table('location_category')->insertGetId([
            'name'       => 'Beauty > Massage',
            'icon_class' => '',
            'status'     => 'publish'
        ]);

        // Create locations
        foreach ($this->massageLocations() as $key => $location) {
            $locationModel = new Location($location);
            $locationModel->category_id = $massageCatId;
            $locationModel->save();
        }

        // --------------------------------------------

        $skinCareCatId = DB::table('location_category')->insertGetId([
            'name'       => 'Beauty > Skin Care',
            'icon_class' => '',
            'status'     => 'publish'
        ]);

        // Create locations
        foreach ($this->skinCareLocations() as $key => $location) {
            $locationModel = new Location($location);
            $locationModel->category_id = $skinCareCatId;
            $locationModel->save();
        }
    }

    private function hairLocations(): array
    {
        $tips_beauty_hair = MediaFile::findMediaByName("tips_beauty_hair")->id;

        return [
            [
                'name' => 'Chic hair salon',
                'content' => '<p></p>',
                'image_id' => $tips_beauty_hair,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Degjin salon',
                'content' => '<p></p>',
                'image_id' => $tips_beauty_hair,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'EKOSS Hair Clinic Salon',
                'content' => '<p></p>',
                'image_id' => $tips_beauty_hair,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Castle hair and beauty salo',
                'content' => '<p></p>',
                'image_id' => $tips_beauty_hair,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Wella Salon Mongolia',
                'content' => '<p></p>',
                'image_id' => $tips_beauty_hair,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'O HUI',
                'content' => '<p></p>',
                'image_id' => $tips_beauty_hair,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
        ];
    }

    private function nailLocations(): array
    {
        $tips_beauty_nail = MediaFile::findMediaByName("tips_beauty_nail")->id;
    
        return [
            [
                'name' => 'Marigold nail salon',
                'content' => '<p></p>',
                'image_id' => $tips_beauty_nail,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'American Beauty nail salon',
                'content' => '<p></p>',
                'image_id' => $tips_beauty_nail,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'ELSA Beauty and Nail salon',
                'content' => '<p></p>',
                'image_id' => $tips_beauty_nail,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Ruby Nail Room',
                'content' => '<p></p>',
                'image_id' => $tips_beauty_nail,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Ecosabun Mongolia',
                'content' => '<p></p>',
                'image_id' => $tips_beauty_nail,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
        ];
    }

    private function massageLocations(): array
    {
        $tips_beauty_massage = MediaFile::findMediaByName("tips_beauty_massage")->id;

        return [
            [
                'name' => 'Lotus Thai Massage',
                'content' => '<p></p>',
                'image_id' => $tips_beauty_massage,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Eco Massage Mongolia',
                'content' => '<p></p>',
                'image_id' => $tips_beauty_massage,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'MUS Float Center',
                'content' => '<p></p>',
                'image_id' => $tips_beauty_massage,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
        ];
    }

    private function skinCareLocations(): array
    {
        $tips_beauty_skincare = MediaFile::findMediaByName("tips_beauty_skincare")->id;

        return [
            [
                'name' => 'Dermaesthetic beauty clinic',
                'content' => '<p></p>',
                'image_id' => $tips_beauty_skincare,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Med Esthetica',
                'content' => '<p></p>',
                'image_id' => $tips_beauty_skincare,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Sos Medica Mongolia',
                'content' => '<p></p>',
                'image_id' => $tips_beauty_skincare,
                'status' => 'publish',
                'parent_id' => null,
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ],
        ];
    }
}
