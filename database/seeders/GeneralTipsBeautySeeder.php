<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Media\Models\MediaFile;

class GeneralTipsBeautySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Setting Tips > Beauty
        $templateId = DB::table('core_templates')->insertGetId([
            'title'       => 'Mongolia Tips: Beauty',
            'content'     => json_encode($this->content()),
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ]);

        if ($templateId) {
            DB::table('core_template_translations')->insert([
                'origin_id'   => $templateId,
                'locale'      => 'ko',
                'title'       => 'Mongolia Tips: Beauty',
                'content'     => json_encode($this->contentKorean()),
                'create_user' => '1',
                'created_at'  => date("Y-m-d H:i:s")
            ]);
        }

        DB::table('core_pages')->insert([
            'title'       => 'Mongolia Tips: Beauty',
            'slug'        => 'tips-beauty',
            'template_id' => $templateId,
            'create_user' => '1',
            'status'      => 'publish',
            'created_at'  => date("Y-m-d H:i:s")
        ]);
    }

    private function content(): array
    {
        $slide_banner_1 = MediaFile::findMediaByName("slide_banner_1")->id;
        $slide_banner_2 = MediaFile::findMediaByName("slide_banner_2")->id;
        $slide_banner_3 = MediaFile::findMediaByName("slide_banner_3")->id;
        $tips_info = MediaFile::findMediaByName("tips_info")->id;
        $tips_shop = MediaFile::findMediaByName("tips_shop")->id;
        $tips_beauty = MediaFile::findMediaByName("tips_beauty")->id;
        $tips_beauty_hair = MediaFile::findMediaByName("tips_beauty_hair")->id;
        $tips_beauty_nail = MediaFile::findMediaByName("tips_beauty_nail")->id;
        $tips_beauty_massage = MediaFile::findMediaByName("tips_beauty_massage")->id;
        $tips_beauty_skincare = MediaFile::findMediaByName("tips_beauty_skincare")->id;

        return [
            [
                "type" => "sub_features",
                "name" => "To Mongolia: Sub Features",
                "model" => [
                    "style" => "icon",
                    "list_item" => [
                        ["_active" => true, "title" => "몽골 정보", "link" => "/page/tips-info-weather", "icon" => $this->getIcon("montips"), "class" => ""],
                        ["_active" => true, "title" => "쇼핑", "link" => "/page/tips-shop", "icon" => $this->getIcon("shop"), "class" => ""],
                        ["_active" => true, "title" => "뷰티", "link" => "/page/tips-beauty", "icon" => $this->getIcon("beauty"), "class" => ""],
                        ["_active" => true, "title" => "Blog", "link" => "/page/tips-blog", "icon" => $this->getIcon("blog"), "class" => ""],
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
                    "style" => "tab-left",
                    "list_item" => [
                        ["_active" => true, "title" => "헤어", "link" => "/page/tips-beauty-hair"],
                        ["_active" => true, "title" => "네일", "link" => "/page/tips-beauty-nail"],
                        ["_active" => true, "title" => "마사지", "link" => "/page/tips-beauty-massage"],
                        ["_active" => true, "title" => "스킨케어", "link" => "/page/tips-beauty-skincare"],
                    ]
                ]
            ],
            [
                "type" => "info_image",
                "name" => "To Mongolia: Info Image",
                "model" => [
                    "title" => "헤어",
                    "desc" => "Explore a new world of immersive entertainment with interactive experiences. From virtual reality games to interactive museum exhibits, these experiences allow you to engage with digital content in ways that were once unimaginable, offering something for everyone.",
                    "button_text" => "Learn more",
                    "button_link" => "/page/tips-beauty-hair",
                    "image_id" => $tips_beauty_hair,
                    "style" => "right"
                ]
            ],
            [
                "type" => "info_image",
                "name" => "To Mongolia: Info Image",
                "model" => [
                    "title" => "네일",
                    "desc" => "Streamline your workflow and stay on top of your work with productivity tools. These apps and software help you manage tasks, track time, and optimize your productivity, so you can achieve your goals and stay competitive in today's fast-paced business environment.",
                    "button_text" => "Learn more",
                    "button_link" => "/page/tips-beauty-nail",
                    "image_id" => $tips_beauty_nail,
                    "style" => "left"
                ]
            ],
            [
                "type" => "info_image",
                "name" => "To Mongolia: Info Image",
                "model" => [
                    "title" => "마사지",
                    "desc" => "Protect your online privacy and stay safe from cyber threats with privacy and security tools. These apps and software help secure your accounts and devices, protect your personal information, and keep you safe from online threats like malware and phishing attacks.",
                    "button_text" => "Learn more",
                    "button_link" => "/page/tips-beauty-massage",
                    "image_id" => $tips_beauty_massage,
                    "style" => "right"
                ]
            ],
            [
                "type" => "info_image",
                "name" => "To Mongolia: Info Image",
                "model" => [
                    "title" => "스킨케어",
                    "desc" => "Protect your online privacy and stay safe from cyber threats with privacy and security tools. These apps and software help secure your accounts and devices, protect your personal information, and keep you safe from online threats like malware and phishing attacks.",
                    "button_text" => "Learn more",
                    "button_link" => "/page/tips-beauty-skincare",
                    "image_id" => $tips_beauty_skincare,
                    "style" => "left"
                ]
            ],
            [
                "type" => "list_news",
                "name" => "News: List Items",
                "model" => [
                    "title" => "Latest blog",
                    "desc" => "",
                    "number" => 3,
                    "category_id" => "",
                    "order" => "id",
                    "order_by" => "desc"
                ]
            ]
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
