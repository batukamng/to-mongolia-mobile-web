<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Media\Models\MediaFile;

class GeneralHomePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Setting Home Page
        $templateId = DB::table('core_templates')->insertGetId([
            'title'       => 'To Mongolia',
            'content'     => json_encode($this->content()),
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ]);

        if ($templateId) {
            DB::table('core_template_translations')->insert([
                'origin_id'   => $templateId,
                'locale'      => 'ko',
                'title'       => 'To Mongolia',
                'content'     => json_encode($this->contentKorean()),
                'create_user' => '1',
                'created_at'  => date("Y-m-d H:i:s")
            ]);
        }

        DB::table('core_pages')->insert([
            'title'       => 'To Mongolia',
            'slug'        => 'home-page',
            'template_id' => $templateId,
            'create_user' => '1',
            'status'      => 'publish',
            'created_at'  => date("Y-m-d H:i:s")
        ]);
    }

    private function content(): array
    {
        $banner_image = MediaFile::findMediaByName("banner-search")->id;
        $banner_home_mix = MediaFile::findMediaByName("home-mix")->id;
        $banner_home_mix_2 = MediaFile::findMediaByName("banner-tour-4")->id;
        $feature_image_montips = MediaFile::findMediaByName("feature_montips")->id;
        $feature_image_montour = MediaFile::findMediaByName("feature_montour")->id;
        $feature_image_findfriend = MediaFile::findMediaByName("feature_findfriend")->id;
        $feature_image_business = MediaFile::findMediaByName("feature_business")->id;
        $slide_banner_1 = MediaFile::findMediaByName("slide_banner_1")->id;
        $slide_banner_2 = MediaFile::findMediaByName("slide_banner_2")->id;
        $slide_banner_3 = MediaFile::findMediaByName("slide_banner_3")->id;

        return [
            [
                "type" => "top_features",
                "name" => "To Mongolia: Top Features",
                "model" => [
                    "style" => "image",
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
                "type" => "list_hotel",
                "name" => "Hotel: List Items",
                "model" => [
                    "title" => "몽골 필수 정보",
                    "desc" => "",
                    "number" => 4,
                    "style" => "carousel",
                    "location_id" => "",
                    "order" => "id",
                    "order_by" => "asc",
                    "is_featured" => "",
                ],
                "component" => "RegularBlock",
                "open" => true,
                "is_container" => false,
            ],
            [
                "type" => "list_tours",
                "name" => "Tour: List Items",
                "model" => [
                    "title" => "몽골 맛집 여행",
                    "number" => 6,
                    "style" => "carousel",
                    "category_id" => "",
                    "location_id" => "",
                    "order" => "id",
                    "order_by" => "asc",
                    "is_featured" => "",
                    "desc" => ""
                ],
                "component" => "RegularBlock",
                "open" => true,
                "is_container" => false,
            ],
            [
                "type" => "list_space",
                "name" => "Space: List Items",
                "model" => [
                    "title" => "현지 전문가와 함께 하는 여행",
                    "desc" => "",
                    "number" => 4,
                    "style" => "carousel",
                    "location_id" => "",
                    "order" => "id",
                    "order_by" => "desc",
                    "is_featured" => "",
                ],
                "component" => "RegularBlock",
                "open" => true,
                "is_container" => false,
            ],
            [
                "type" => "list_car",
                "name" => "Car: List Items",
                "model" => [
                    "title" => "몽골 인기 패키지 상품",
                    "desc" => "",
                    "number" => 8,
                    "style" => "carousel",
                    "location_id" => "",
                    "order" => "id",
                    "order_by" => "desc",
                    "is_featured" => "",
                ],
                "component" => "RegularBlock",
                "open" => true,
            ],
            [
                "type" => "list_event",
                "name" => "Event: List Items",
                "model" => [
                    "title" => "몽골 비즈니스",
                    "desc" => "",
                    "number" => 4,
                    "style" => "carousel",
                    "location_id" => "",
                    "order" => "",
                    "order_by" => "",
                    "is_featured" => "",
                ],
                "component" => "RegularBlock",
                "open" => true,
            ],
            // [
            //     "type" => "list_boat",
            //     "name" => "Boat: List Items",
            //     "model" => [
            //         "title" => "Restaurant Listing",
            //         "desc" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry",
            //         "number" => 4,
            //         "style" => "carousel",
            //         "location_id" => "",
            //         "order" => "id",
            //         "order_by" => "asc",
            //         "is_featured" => "",
            //         "custom_ids" => "",
            //     ],
            //     "component" => "RegularBlock",
            //     "open" => true,
            //     "is_container" => false,
            // ],
            [
                "type" => "list_news",
                "name" => "News: List Items",
                "model" => [
                    "title" => "몽골 여행 이야기",
                    "desc" => "",
                    "number" => 6,
                    "category_id" => null,
                    "order" => "id",
                    "order_by" => "asc",
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
