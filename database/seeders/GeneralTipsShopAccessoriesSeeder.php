<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Media\Models\MediaFile;
use Modules\Location\Models\LocationCategory;

class GeneralTipsShopAccessoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Setting Tips > Shop > Accessories
        $templateId = DB::table('core_templates')->insertGetId([
            'title'       => 'Shop: Accessories',
            'content'     => json_encode($this->content()),
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ]);

        if ($templateId) {
            DB::table('core_template_translations')->insert([
                'origin_id'   => $templateId,
                'locale'      => 'ko',
                'title'       => 'Shop: Accessories',
                'content'     => json_encode($this->contentKorean()),
                'create_user' => '1',
                'created_at'  => date("Y-m-d H:i:s")
            ]);
        }

        DB::table('core_pages')->insert([
            'title'       => 'Shop: Accessories',
            'slug'        => 'tips-shop-accessories',
            'template_id' => $templateId,
            'content'     => $this->pageContent(),
            'create_user' => '1',
            'status'      => 'publish',
            'created_at'  => date("Y-m-d H:i:s")
        ]);
    }

    private function pageContent(): string
    {
        return '<h1>Accessories</h1>
        <p>
        한번도 안 가본 사람은 많아도 한 번만 가본 사람은 없다는 몽골. 몽골은 한겨울 영하 30도가 보통, 여름에는 영상 33도-38도이며  연평균 기온이 영하 2.9도로 일년 내내 추우며 일교차도 큰 편입니다. 전형적인 대륙성 기후로 겨울이 길고 춥습니다. 그러나 일년에 단 3개월, 짧은 기간이지만 6월부터 8월까지는 세계 어느 여행지보다 날씨가 좋습니다. 건조한 기후특성으로 여름에도 그늘에서는 더위가 심하지 않습니다.  몽골의 기후는 건성 냉대기후의 특징을 띄는데요. 말 그대로 건조하고 추운날씨를 중점적으로 보이는 기후라고 볼 수 있습니다다. 이는 전형적인 대륙성 기후로, 계절 구분이 명확하다는 특징도 가집니다. 연평균 기온은 영하 2.9℃로 상당히 추운 편에 속합니다만 여행 성수기인 6월부터 9월까지 여행 강추 나라입니다.
        </p>
        <br>';
    }

    private function content(): array
    {
        $slide_banner_1 = MediaFile::findMediaByName("slide_banner_1")->id;
        $slide_banner_2 = MediaFile::findMediaByName("slide_banner_2")->id;
        $slide_banner_3 = MediaFile::findMediaByName("slide_banner_3")->id;
        $catId = LocationCategory::where('name', 'Shop > Accessory')->first()->id;

        return [
            [
                "type" => "sub_features",
                "name" => "To Mongolia: Sub Features",
                "model" => [
                    "style" => "icon",
                    "list_item" => [
                        ["_active" => true, "title" => "몽골 정보", "link" => "/page/tips-info-weather", "icon" => $this->getIcon("montips"), "class" => ""],
                        ["_active" => true, "title" => "쇼핑", "link" => "/page/tips-shop", "icon" => $this->getIcon("shop"), "class" => "active"],
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
                        ["_active" => true, "title" => "캐시미어", "link" => "/page/tips-shop-cashmere"],
                        ["_active" => true, "title" => "백화점", "link" => "/page/tips-shop-department-store"],
                        ["_active" => true, "title" => "명품", "link" => "/page/tips-shop-luxury-brand"],
                        ["_active" => true, "title" => "추천 아이템", "link" => "/page/tips-shop-accessories"],
                    ]
                ]
            ],
            [
                "type" => "tip_locations",
                "name" => "To Mongolia: Tip Locations",
                "model" => [
                    "title" => "추천 아이템",
                    "desc" => "",
                    "number" => 6,
                    "order" => "id",
                    "order_by" => "desc",
                    "category_id" => $catId,
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
