<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Media\Models\MediaFile;

class GeneralHomeCarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Setting Home Car
        $templateId = DB::table('core_templates')->insertGetId([
            'title'       => 'To Mongolia: Car',
            'content'     => json_encode($this->content()),
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ]);

        if ($templateId) {
            DB::table('core_template_translations')->insert([
                'origin_id'   => $templateId,
                'locale'      => 'ko',
                'title'       => 'To Mongolia: Car',
                'content'     => json_encode($this->contentKorean()),
                'create_user' => '1',
                'created_at'  => date("Y-m-d H:i:s")
            ]);
        }

        DB::table('core_pages')->insert([
            'title'       => 'To Mongolia: Car',
            'slug'        => 'car',
            'template_id' => $templateId,
            'create_user' => '1',
            'status'      => 'publish',
            'created_at'  => date("Y-m-d H:i:s")
        ]);
    }

    private function content(): array
    {
        $feature_image_montips = MediaFile::findMediaByName("feature_montips")->id;
        $feature_image_montour = MediaFile::findMediaByName("feature_montour")->id;
        $feature_image_findfriend = MediaFile::findMediaByName("feature_findfriend")->id;
        $feature_image_business = MediaFile::findMediaByName("feature_business")->id;
        $banner_image = MediaFile::findMediaByName("banner-search")->id;
        $banner_home_mix = MediaFile::findMediaByName("home-mix")->id;
        $banner_home_mix_2 = MediaFile::findMediaByName("banner-tour-4")->id;
        $avatar = MediaFile::findMediaByName("avatar")->id;
        $avatar_2 = MediaFile::findMediaByName("avatar-2")->id;
        $avatar_3 = MediaFile::findMediaByName("avatar-3")->id;
        $slide_banner_1 = MediaFile::findMediaByName("slide_banner_1")->id;
        $slide_banner_2 = MediaFile::findMediaByName("slide_banner_2")->id;
        $slide_banner_3 = MediaFile::findMediaByName("slide_banner_3")->id;
        
        return [
            [
                "type" => "top_features",
                "name" => "To Mongolia: Top Features",
                "model" => [
                    "style" => "icon",
                    "list_item" => [
                        ["_active" => true, "title" => "Mongolia Tips", "link" => "/page/tips", "image_id" => $feature_image_montips, "icon" => $this->getIcon("montips")],
                        ["_active" => true, "title" => "Mongolia Tour", "link" => "/page/tour", "image_id" => $feature_image_montour, "icon" => $this->getIcon("montour")],
                        ["_active" => true, "title" => "Find Friend", "link" => "/community", "image_id" => $feature_image_findfriend, "icon" => $this->getIcon("findfriend")],
                        ["_active" => true, "title" => "Business", "link" => "/page/business", "image_id" => $feature_image_business, "icon" => $this->getIcon("business")],
                    ]
                ]
            ],
            [
                "type" => "slide_banners",
                "name" => "To Mongolia: Slide Banners",
                "model" => [
                    "list_item" => [
                        ["_active" => true, "title" => "Banner 1", "image_id" => $slide_banner_1],
                        ["_active" => true, "title" => "Banner 2", "image_id" => $slide_banner_2],
                        ["_active" => true, "title" => "Banner 3", "image_id" => $slide_banner_3],
                    ]
                ]
            ],
            [
                "type" => "sub_features",
                "name" => "To Mongolia: Sub Features",
                "model" => [
                    "style" => "icon",
                    "list_item" => [
                        ["_active" => true, "title" => "Day Tour", "link" => "/page/tour", "icon" => $this->getIcon("daytour")],
                        ["_active" => true, "title" => "Package", "link" => "/page/package", "icon" => $this->getIcon("package")],
                        ["_active" => true, "title" => "Transport", "link" => "/car", "icon" => $this->getIcon("transport")],
                        ["_active" => true, "title" => "Activity", "link" => "/page/event", "icon" => $this->getIcon("activity")],
                        ["_active" => true, "title" => "Restaurant", "link" => "/page/restaurant", "icon" => $this->getIcon("restaurant")],
                        ["_active" => true, "title" => "Hotel & House", "link" => "/page/tour-hotel", "icon" => $this->getIcon("hotel")],
                    ]
                ]
            ],
            [
                "type" => "list_car",
                "name" => "Car: List Items",
                "model" => [
                    "title" => "Trending used cars",
                    "desc" => "Book incredible things to do around the world.",
                    "number" => 8,
                    "style" => "carousel",
                    "location_id" => "",
                    "order" => "id",
                    "order_by" => "desc",
                    "is_featured" => ""
                ],
                "component" => "RegularBlock",
                "open" => true,
                "is_container" => false
            ],
            [
                "type" => "how_it_works",
                "name" => "How It Works",
                "model" => [
                    "title" => "How does it work?",
                    "list_item" => [
                        ["_active" => false,"title" => "Find The Car", "sub_title" => "Lorem Ipsum is simply dummy text of the printing", "icon_image" => 132,"order" => null],
                        ["_active" => false,"title" => "Book It", "sub_title" => "Lorem Ipsum is simply dummy text of the printing", "icon_image" => 133,"order" => null],
                        ["_active" => false,"title" => "Grab And Go", "sub_title" => "Lorem Ipsum is simply dummy text of the printing", "icon_image" => 134,"order" => null]
                    ],
                    "background_image" => 131
                ],
                "component" => "RegularBlock",
                "open" => true,
                "is_container" => false,
            ],
        ];
    }

    private function contentKorean(): array
    {
        return $this->content();
    }

    private function getIcon($type): string
    {
        return svg_icon_set($type);
    }
}
