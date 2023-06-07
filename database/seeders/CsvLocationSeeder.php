<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\Media\Models\MediaFile;
use Modules\Location\Models\Location;
use Modules\Location\Models\LocationTranslation;

class CsvLocationSeeder extends Seeder
{
    const CSV_DIR = 'data/csv';
    const CSV_RESOURCE = [
        'location' => [
            'file' => 'location_data_20230307.csv',
            'mapping' => [
                0 => 'timestamp',
                1 => 'province',
                2 => 'title_en',
                3 => 'title_ko',
                4 => 'desc_ko',
                5 => 'desc_en',
                6 => 'about_en',
                7 => 'about_ko',
                8 => 'cover_image_link',
                9 => 'thumb_image_link',
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
        $this->seedLocationResource(database_path(self::CSV_DIR . '/' . self::CSV_RESOURCE['location']['file']), self::CSV_RESOURCE['location']['mapping']);
    }

    public function seedLocationResource($csvPath, $csvMapping) {
        $contents = csv_get_contents($csvPath);
        $parsed = [
            'header' => csv_map_contents($contents[0], $csvMapping),
            'data' => csv_map_contents(array_slice($contents, 1), $csvMapping, true),
        ];

        foreach ($parsed['data'] as $index => $data) {
            $coverId = download_save_media($data['cover_image_link'], 'csv_media/landmarks/');
            $thumbId = download_save_media($data['thumb_image_link'], 'csv_media/landmarks/');
            $location = Location::where('slug', Str::slug($data['province'], '-'))->first();
            $item = $this->createResource($data, null, null, $location ? $location->id : null);
            $itemTranslation = $this->createTranslation($data, $item->id);
        }
    }

    private function createResource($data, $imageId = null, $bannerImageId = null, $locationId = null) {
        return Location::create([
            'name' => $data['title_en'],
            'slug' => Str::slug($data['province'], '-'),
            'content' => $data['desc_en'],
            'image_id' => $imageId,
            'banner_image_id' => $bannerImageId,
            'status' => 'publish',
            'parent_id' => $locationId,
            'create_user' => '1',
            'created_at' =>  date("Y-m-d H:i:s")
        ]);
    }

    private function createTranslation($data, $originId) {
        return LocationTranslation::create([
            'origin_id' => $originId,
            'name' => $data['title_ko'],
            'content' => $data['desc_ko'],
            'locale' => 'ko',
            'create_user' => '1',
        ]);
    }
}
