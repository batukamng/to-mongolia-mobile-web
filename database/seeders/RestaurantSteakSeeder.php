<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Media\Models\MediaFile;

use Modules\Review\Models\Review;
use Modules\Review\Models\ReviewMeta;


class RestaurantSteakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $templateId = DB::table('core_templates')->insertGetId([
            'title'       => 'To Mongolia: Steak',
            'content'     => json_encode($this->content()),
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ]);

        if ($templateId) {
            DB::table('core_template_translations')->insert([
                'origin_id'   => $templateId,
                'locale'      => 'ko',
                'title'       => 'To Mongolia: Steak',
                'content'     => json_encode($this->contentKorean()),
                'create_user' => '1',
                'created_at'  => date("Y-m-d H:i:s")
            ]);
        }

        DB::table('core_pages')->insert([
            'title'       => 'To Mongolia: Steak',
            'slug'        => 'steak',
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
                "type" => "sub_features",
                "name" => "To Mongolia: Top Features",
                "model" => [
                    "style" => "icon",
                    "list_item" => [
                        ["_active" => true, "title" => "Day Tour", "link" => "/page/day-tour", "icon" => $this->getIcon("daytour")],
                        ["_active" => true, "title" => "Package", "link" => "/page/package", "icon" => $this->getIcon("package")],
                        ["_active" => true, "title" => "Transport", "link" => "/car", "icon" => $this->getIcon("transport")],
                        ["_active" => true, "title" => "Activity", "link" => "/page/event", "icon" => $this->getIcon("activity")],
                        ["_active" => true, "title" => "Restaurant", "link" => "/page/restaurant", "icon" => $this->getIcon("restaurant")],
                        ["_active" => true, "title" => "Hotel & House", "link" => "/page/tour-hotel", "icon" => $this->getIcon("hotel")],
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
                        ["_active" => true, "title" => "Steak", "link" => "/page/steak"],
                        ["_active" => true, "title" => "Mongolian", "link" => "/page/mongolianfood"],
                        ["_active" => true, "title" => "Korean", "link" => "/page/koreanfood"],
                        ["_active" => true, "title" => "Japanese", "link" => "/page/japanesefood"],
                        ["_active" => true, "title" => "Chinese", "link" => "/page/chinesefood"],
                        ["_active" => true, "title" => "Vegan", "link" => "/page/vegan"],
                        ["_active" => true, "title" => "Suggestion", "link" => "/page/suggestion"],
                    ]
                ]
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
