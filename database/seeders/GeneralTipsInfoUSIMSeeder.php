<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Media\Models\MediaFile;

class GeneralTipsInfoUSIMSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Setting Tips > Info > USIM/WiFi
        $templateId = DB::table('core_templates')->insertGetId([
            'title'       => 'Mongolia Info: USIM/WiFi',
            'content'     => json_encode($this->content()),
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ]);

        if ($templateId) {
            DB::table('core_template_translations')->insert([
                'origin_id'   => $templateId,
                'locale'      => 'ko',
                'title'       => 'Mongolia Info: USIM/WiFi',
                'content'     => json_encode($this->contentKorean()),
                'create_user' => '1',
                'created_at'  => date("Y-m-d H:i:s")
            ]);
        }

        DB::table('core_pages')->insert([
            'title'       => 'Mongolia Info: USIM/WiFi',
            'slug'        => 'tips-info-usim-wifi',
            'template_id' => $templateId,
            'content'     => $this->pageContent(),
            'create_user' => '1',
            'status'      => 'publish',
            'created_at'  => date("Y-m-d H:i:s")
        ]);
    }

    private function pageContent(): string
    {
        return '<h3>Mobicom</h3>
        <p>Mobicom Corporation LLC is the largest telecommunications company in Mongolia, providing mobile and fixed-line services, broadband internet, and other related services. The company was established in 1996 and is headquartered in Ulaanbaatar, Mongolia.</p>
        <p>The company operates a 4G LTE network covering more than 90% of Mongolia\'s population, and is currently upgrading to 5G technology. Mobicom has partnerships with several international telecom companies, enabling its customers to roam in more than 200 countries worldwide.</p>
        <p><img class="w-100" src="/uploads/demo/general/tips-info-usim-mobicom.png" alt="" /></p>
        <br>
        <h3>Unitel</h3>
        <p>Unitel LLC is another major telecommunications company in Mongolia, providing mobile, fixed-line, and internet services to customers across the country. The company was established in 2005 and is headquartered in Ulaanbaatar, Mongolia.</p>
        <p>The company operates a 4G LTE network covering more than 95% of Mongolia\'s population, and has recently started testing 5G technology in some areas. Unitel has partnerships with several international telecom companies, enabling its customers to roam in more than 170 countries worldwide.</p>
        <p><img class="w-100" src="/uploads/demo/general/tips-info-usim-unitel.png" alt="" /></p>';
    }

    private function content(): array
    {
        $slide_banner_1 = MediaFile::findMediaByName("slide_banner_1")->id;
        $slide_banner_2 = MediaFile::findMediaByName("slide_banner_2")->id;
        $slide_banner_3 = MediaFile::findMediaByName("slide_banner_3")->id;

        return [
            [
                "type" => "sub_features",
                "name" => "To Mongolia: Sub Features",
                "model" => [
                    "style" => "icon",
                    "list_item" => [
                        ["_active" => true, "title" => "몽골 정보", "link" => "/page/tips-info-weather", "icon" => $this->getIcon("montips"), "class" => "active"],
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
                    "style" => "tab",
                    "list_item" => [
                        ["_active" => true, "title" => "Weather", "link" => "/page/tips-info-weather"],
                        ["_active" => true, "title" => "Exchange", "link" => "/page/tips-info-exchange"],
                        ["_active" => true, "title" => "USIM/WIFI", "link" => "/page/tips-info-usim-wifi"],
                    ]
                ]
            ],
            [
                "type" => "page_content",
                "name" => "To Mongolia: Page Content",
                "model" => [
                    "class" => "col-lg-8 offset-lg-2 px-0 py-2"
                ]
            ],
            [
                "type" => "list_tours",
                "name" => "Tour: List Items",
                "model" => [
                    "title" => "이런 여행 어때요 ?",
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
