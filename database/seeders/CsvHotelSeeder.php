<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\Media\Models\MediaFile;
use Modules\Location\Models\Location;
use Modules\Hotel\Models\Hotel;
use Modules\Hotel\Models\HotelTranslation;

class CsvHotelSeeder extends Seeder
{
    const CSV_DIR = 'data/csv';
    const CSV_RESOURCE = [
        'hotel' => [
            'file' => 'hotel_data_20230307.csv',
            'mapping' => [
                0 => 'timestamp',
                1 => 'province',
                2 => 'title_en',
                3 => 'title_ko',
                4 => 'desc_en',
                5 => 'desc_ko',
                6 => 'about_en',
                7 => 'about_ko',
                8 => 'cover_image_link',
                9 => 'thumb_image_link',
                10 => 'hotel_rating',
            ]
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedHotelResource(database_path(self::CSV_DIR . '/' . self::CSV_RESOURCE['hotel']['file']), self::CSV_RESOURCE['hotel']['mapping']);
    }

    public function seedHotelResource($csvPath, $csvMapping) {
        $contents = csv_get_contents($csvPath);
        $parsed = [
            'header' => csv_map_contents($contents[0], $csvMapping),
            'data' => csv_map_contents(array_slice($contents, 1), $csvMapping, true),
        ];

        foreach ($parsed['data'] as $index => $data) {
            $coverId = download_save_media($data['cover_image_link'], 'csv_media/hotels/');
            $thumbId = download_save_media($data['thumb_image_link'], 'csv_media/hotels/');
            $location = Location::where('slug', Str::slug($data['province'], '-'))->first();
            $item = $this->createResource($data, $coverId, $thumbId, $location ? $location->id : null);
            $itemTranslation = $this->createTranslation($data, $item->id);
        }
    }

    private function createResource($data, $imageId = null, $bannerImageId = null, $locationId = null) {
        return Hotel::create([
            'title' => $data['title_en'],
            'slug' => Str::slug($data['title_en'], '-'),
            'content' => $data['desc_en'],
            'image_id' => $imageId,
            'banner_image_id' => $bannerImageId,
            'status' => 'publish',
            'location_id' => $locationId,
            'star_rate' => intval($data['hotel_rating']),
            'create_user' => '1',
            'created_at' =>  date("Y-m-d H:i:s")
        ]);
    }

    private function createTranslation($data, $originId) {
        return HotelTranslation::create([
            'origin_id' => $originId,
            'title' => $data['title_ko'],
            'content' => $data['desc_ko'],
            'locale' => 'ko',
            'create_user' => '1',
        ]);
    }
}
