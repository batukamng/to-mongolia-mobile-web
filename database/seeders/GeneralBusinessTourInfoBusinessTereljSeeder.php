<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Media\Models\MediaFile;

class GeneralBusinessTourInfoBusinessTereljSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Setting Tips > Info > Weather
        $templateId = DB::table('core_templates')->insertGetId([
            'title'       => 'Business: Business terelj',
            'content'     => json_encode($this->content()),
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ]);

        if ($templateId) {
            DB::table('core_template_translations')->insert([
                'origin_id'   => $templateId,
                'locale'      => 'ko',
                'title'       => 'Business: Business terelj',
                'content'     => json_encode($this->contentKorean()),
                'create_user' => '1',
                'created_at'  => date("Y-m-d H:i:s")
            ]);
        }

        DB::table('core_pages')->insert([
            'title'       => 'Business: Business terelj',
            'slug'        => 'businessterelj',
            'template_id' => $templateId,
            'content'     => $this->pageContent(),
            'create_user' => '1',
            'status'      => 'publish',
            'created_at'  => date("Y-m-d H:i:s")
        ]);
    }

    private function pageContent(): string
    {
        return '<h2>Tour information</h2>
        <p>한번도 안 가본 사람은 많아도 한 번만 가본 사람은 없다는 몽골. 몽골은 한겨울 영하 30도가 보통, 여름에는 영상 33도-38도이며 연평균 기온이 영하 2.9도로 일년 내내 추우며 일교차도 큰 편입니다. 전형적인 대륙성 기후로 겨울이 길고 춥습니다. 그러나 일년에 단 3개월, 짧은 기간이지만 6월부터 8월까지는 세계 어느 여행지보다 날씨가 좋습니다. 건조한 기후특성으로 여름에도 그늘에서는 더위가 심하지 않습니다. 몽골의 기후는 건성 냉대기후의 특징을 띄는데요. 말 그대로 건조하고 추운날씨를 중점적으로 보이는 기후라고 볼 수 있습니다다. 이는 전형적인 대륙성 기후로, 계절 구분이 명확하다는 특징도 가집니다. 연평균 기온은 영하 2.9℃로 상당히 추운 편에 속합니다만 여행 성수기인 6월부터 9월까지 여행 강추 나라입니다.</p>
        <p><a href="https://www.accuweather.com/" target="_blank" rel="noreferrer noopener">Get current weather information</a></p>
        <p><img class="w-100" src="/uploads/demo/general/tips-info-weather.png" alt="" /></p>';
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
                "type" => "sub_features",
                "name" => "To Mongolia: Top Features",
                "model" => [
                    "style" => "icon",
                    "list_item" => [
                        ["_active" => true, "title" => "전문 통역", "link" => "/page/translate", "icon" => $this->getIcon("translate")],
                        ["_active" => true, "title" => "차량", "link" => "/page/vehicle", "icon" => $this->getIcon("vehicle")],
                        ["_active" => true, "title" => "호텔", "link" => "/page/hotelinfo", "icon" => $this->getIcon("hotelinfo")],
                        ["_active" => true, "title" => "투어", "link" => "/page/tourinfo", "icon" => $this->getIcon("tourinfo")],
                        ["_active" => true, "title" => "Food", "link" => "/page/food", "icon" => $this->getIcon("food")],
                        ["_active" => true, "title" => "금융", "link" => "/page/finance", "icon" => $this->getIcon("finance")],
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
                    "style" => "tab",
                    "list_item" => [
                        ["_active" => true, "title" => "Terelj", "link" => "/page/businessterelj"],
                        ["_active" => true, "title" => "Golf", "link" => "/page/businessgolf"],
                        ["_active" => true, "title" => "UB tour", "link" => "/page/businessubtour"],
                    ]
                ]
            ],
            [
                "type" => "list_tours",
                "name" => "Tour: List Items",
                "model" => [
                    "title" => "Trending Tours",
                    "number" => 5,"style" => "carousel",
                    "category_id" => "",
                    "location_id" => "",
                    "order" => "id",
                    "order_by" => "desc",
                ],
                "component" => "RegularBlock",
                "open" => true,
                "is_container" => false,
            ],
            [
                "type" => "list_tours",
                "name" => "Tour: List Items",
                "model" => [
                    "title" => "Local Experiences You'll Love",
                    "number" => 8,
                    "style" => "normal",
                    "category_id" => "",
                    "location_id" => "",
                    "order" => "id",
                    "order_by" => "asc",
                ],
                "component" => "RegularBlock",
                "open" => true,
                "is_container" => false,
            ],
            [
                "type" => "call_to_action",
                "name" => "Call To Action",
                "model" => [
                    "title" => "Know your city?",
                    "sub_title" => "Join 2000+ locals & 1200+ contributors from 3000 cities",
                    "link_title" => "Become Local Expert",
                    "link_more" => "/page/become-a-vendor",
                ],
                "component" => "RegularBlock",
                "open" => true,
                "is_container" => false,
            ],
            [
                "type" => "testimonial",
                "name" => "List Testimonial",
                "model" => [
                    "title" => "Our happy clients",
                    "list_item" => [
                        [
                            "_active" => false,
                            "name" => "Eva Hicks",
                            "desc" => "Faucibus tristique felis potenti ultrices ornare rhoncus semper hac facilisi Rutrum tellus lorem sem velit nisi non pharetra in dui. ",
                            "number_star" => 5,
                            "avatar" => $avatar,
                        ],
                        [
                            "_active" => false,
                            "name" => "Donald Wolf",
                            "desc" => "Faucibus tristique felis potenti ultrices ornare rhoncus semper hac facilisi Rutrum tellus lorem sem velit nisi non pharetra in dui. ",
                            "number_star" => 6,
                            "avatar" => $avatar_2,
                        ],
                        [
                            "_active" => false,
                            "name" => "Charlie Harrington",
                            "desc" => "Faucibus tristique felis potenti ultrices ornare rhoncus semper hac facilisi Rutrum tellus lorem sem velit nisi non pharetra in dui.",
                            "number_star" => 5,
                            "avatar" => $avatar_3,
                        ]
                    ],
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
