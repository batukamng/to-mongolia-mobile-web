<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Modules\Boat\Models\Boat;
use Modules\Boat\Models\BoatTranslation;

class CsvRestaurantSeeder extends Seeder
{
    const CSV_DIR = 'data/csv';
    const CSV_RESOURCE = [
        'restaurant' => [
            'file' => 'restaurant_data_20230307.csv',
            'mapping' => [
                0 => 'timestamp',
                1 => 'title_en',
                2 => 'title_ko',
                3 => 'desc_en',
                4 => 'desc_ko',
                5 => 'about_en',
                6 => 'about_ko',
                7 => 'open_hour',
                8 => 'close_hour',
                9 => 'cover_image_link',
                10 => 'thumb_image_link',
                11 => 'category',
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
        $this->seedRestaurantResource(database_path(self::CSV_DIR . '/' . self::CSV_RESOURCE['restaurant']['file']), self::CSV_RESOURCE['restaurant']['mapping']);
    }

    public function seedRestaurantResource($csvPath, $csvMapping) {
        $contents = csv_get_contents($csvPath);
        $parsed = [
            'header' => csv_map_contents($contents[0], $csvMapping),
            'data' => csv_map_contents(array_slice($contents, 1), $csvMapping, true),
        ];

        foreach ($parsed['data'] as $index => $data) {
            $coverId = download_save_media($data['cover_image_link'], 'csv_media/restaurants/');
            $thumbId = download_save_media($data['thumb_image_link'], 'csv_media/restaurants/');
            $item = $this->createResource($data, $coverId, $thumbId);
            $itemTranslation = $this->createTranslation($data, $item->id);

            $catArr = explode(',', $data['category']);
            $catArr = array_map(function($cat) {
                return trim($cat);
            }, $catArr);
            $catTerms = \Modules\Core\Models\Terms::whereIn('name', $catArr)->select('id')->get();
            $item->terms()->createMany(array_map(function($term) {
                return ['term_id' => $term['id']];
            }, $catTerms->toArray()));
        }
    }

    private function createResource($data, $imageId, $bannerImageId) {
        return Boat::create([
            'title' => $data['title_en'],
            'slug' => Str::slug($data['title_en'], '-'),
            'content' => $data['about_en'],
            'image_id' => $imageId,
            'banner_image_id' => $bannerImageId,
            'status' => "publish",
            'faqs' => '[{"title":"When should I check the transmission fluid?","content":"You should check the transmission fluid regularly. Try to check it at least once a month or at the sign of any trouble, for instance if there is any hesitation when you shift gears in an automatic."},{"title":"How do I check the transmission fluid?","content":"It\u2019s not hard to check your transmission fluid if the vehicle is an automatic. This link to the Dummies guide to checking your transmission fluid has step-by-step instructions and illustrations that show you where to locate the dipstick. What you want is clear, pink transmission fluid. If it is low, top it up. If it is dark, smells burnt or has bits in it then you need to get it changed by at a reliable auto repair shop."},{"title":"Is it really that important to check the transmission fluid?","content":"Yes, it can be. Often times the symptoms you\u2019ll experience from low or dirty transmission fluid will be the same as transmission problems. If you check the fluid levels regularly and refill as necessary then you\u2019ll know if there are any symptoms of trouble that it\u2019s not because the fluid levels are low and you need to see a mechanic."},{"title":"Are there different types of transmission fluid?","content":"How do I know what to buy? Yes, there are many different types of transmission fluid, each designed for a certain transmission. Different vehicles require different transmission fluids and the age of the restaurant can also be a factor because newer transmissions take different types of transmission fluids than older vehicles. Don\u2019t guess! Find out which type of transmission fluid is required for your vehicle by checking your owner\u2019s manual."},{"title":"What is a transmission flush and should I get one?","content":"A transmission flush is used by some auto repair shops with the goal of flushing out debris.  Auto Tech does not do any sort of transmission flush.  Flushing an older transmission can cause harmful sediment to get stuck in the solenoids of the transmission. We heavily favor regular maintenance to lengthen the life of your transmission.  We service the transmission by changing fluid and the filter and do not recommend having your transmission flushed."},{"title":"How do I know I have a fluid leak from the transmission?","content":"Transmission fluid is slightly pink in color \u2013 it will appear pink or red, or possibly more brownish if the transmission fluid is dirty and needs to be replaced. When you feel transmission fluid it will be slick and oily on your fingers. It smells much like oil unless it is dirty, in which case it will smell burnt. Usually transmission fluid leaks around the front or middle of your vehicle, so if you find puddles of reddish liquid there it is probably transmission fluid. Another clue is if in addition to the leak your transmission is not working well and you notice changes in the way it sounds when you shift gears, or if shifting gears is not working as well. In this case you likely have a leak of transmission fluid that is impacting how your transmission operates."}]',
        ]);
    }

    private function createTranslation($data, $originId) {
        return BoatTranslation::create([
            'origin_id' => $originId,
            'title' => $data['title_ko'],
            'content' => $data['about_ko'],
            'faqs' => '[{"title":"When should I check the transmission fluid?","content":"You should check the transmission fluid regularly. Try to check it at least once a month or at the sign of any trouble, for instance if there is any hesitation when you shift gears in an automatic."},{"title":"How do I check the transmission fluid?","content":"It\u2019s not hard to check your transmission fluid if the vehicle is an automatic. This link to the Dummies guide to checking your transmission fluid has step-by-step instructions and illustrations that show you where to locate the dipstick. What you want is clear, pink transmission fluid. If it is low, top it up. If it is dark, smells burnt or has bits in it then you need to get it changed by at a reliable auto repair shop."},{"title":"Is it really that important to check the transmission fluid?","content":"Yes, it can be. Often times the symptoms you\u2019ll experience from low or dirty transmission fluid will be the same as transmission problems. If you check the fluid levels regularly and refill as necessary then you\u2019ll know if there are any symptoms of trouble that it\u2019s not because the fluid levels are low and you need to see a mechanic."},{"title":"Are there different types of transmission fluid?","content":"How do I know what to buy? Yes, there are many different types of transmission fluid, each designed for a certain transmission. Different vehicles require different transmission fluids and the age of the restaurant can also be a factor because newer transmissions take different types of transmission fluids than older vehicles. Don\u2019t guess! Find out which type of transmission fluid is required for your vehicle by checking your owner\u2019s manual."},{"title":"What is a transmission flush and should I get one?","content":"A transmission flush is used by some auto repair shops with the goal of flushing out debris.  Auto Tech does not do any sort of transmission flush.  Flushing an older transmission can cause harmful sediment to get stuck in the solenoids of the transmission. We heavily favor regular maintenance to lengthen the life of your transmission.  We service the transmission by changing fluid and the filter and do not recommend having your transmission flushed."},{"title":"How do I know I have a fluid leak from the transmission?","content":"Transmission fluid is slightly pink in color \u2013 it will appear pink or red, or possibly more brownish if the transmission fluid is dirty and needs to be replaced. When you feel transmission fluid it will be slick and oily on your fingers. It smells much like oil unless it is dirty, in which case it will smell burnt. Usually transmission fluid leaks around the front or middle of your vehicle, so if you find puddles of reddish liquid there it is probably transmission fluid. Another clue is if in addition to the leak your transmission is not working well and you notice changes in the way it sounds when you shift gears, or if shifting gears is not working as well. In this case you likely have a leak of transmission fluid that is impacting how your transmission operates."}]',
            'locale' => 'ko',
            'create_user' => '1',
        ]);
    }
}
