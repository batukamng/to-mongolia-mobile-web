<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Media\Models\MediaFile;

class ContactUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Setting Become Vendor
        $templateId = DB::table('core_templates')->insertGetId([
            'title'       => 'Contact us',
            'content'     => json_encode($this->content()),
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ]);

        if ($templateId) {
            DB::table('core_template_translations')->insert([
                'origin_id'   => $templateId,
                'locale'      => 'ko',
                'title'       => 'Contact us',
                'content'     => json_encode($this->contentKorean()),
                'create_user' => '1',
                'created_at'  => date("Y-m-d H:i:s")
            ]);
        }

        DB::table('core_pages')->insert([
            'title'       => 'Contact us',
            'slug'        => 'contact-us',
            'template_id' => $templateId,
            'create_user' => '1',
            'status'      => 'publish',
            'created_at'  => date("Y-m-d H:i:s")
        ]);
    }

    private function content(): array
    {
        $banner_image_vendor_register = MediaFile::findMediaByName("thumb-vendor-register")->id;
        $video_bg = MediaFile::findMediaByName("bg-video-vendor-register1")->id;
        $ico_chat_1 = MediaFile::findMediaByName("ico_chat_1")->id;
        $ico_friendship_1 = MediaFile::findMediaByName("ico_friendship_1")->id;
        $ico_piggy_bank_1 = MediaFile::findMediaByName("ico_piggy-bank_1")->id;

        return [
            [
                "type" => "text",
                "name" => "Text",
                "model" => [
                    "content" => "<h3><strong>How does it work?</strong></h3>",
                    "class" => "text-center"
                ],
                "component" => "RegularBlock",
                "open" => true,
                "is_container" => false,
            ],
            [
                "type" => "list_featured_item",
                "name" => "List Featured Item",
                "model" => [
                    "list_item" => [
                        ["_active" => false,"title" => "Sign up", "sub_title" => "Click edit button to change this text  to change this text", "icon_image" => null, "order" => null],
                        ["_active" => false,"title" => " Add your services", "sub_title" => " Click edit button to change this text  to change this text", "icon_image" => null, "order" => null],
                        ["_active" => true, "title" => "Get bookings", "sub_title" => " Click edit button to change this text  to change this text", "icon_image" => null, "order" => null],
                    ],
                    "style" => "style2"
                ],
                "component" => "RegularBlock",
                "open" => true,
                "is_container" => false,
            ],
            [
                "type" => "video_player",
                "name" => "Video Player",
                "model" => [
                    "title" => "Share the beauty of your city",
                    "youtube" => "https://www.youtube.com/watch?v=B65sguVXgiw",
                    "bg_image" => $video_bg
                ],
                "component" => "RegularBlock",
                "open" => true,
                "is_container" => false,
            ],
            [
                "type" => "text",
                "name" => "Text",
                "model" => [
                    "content" => "<h3><strong>Why be a Local Expert</strong></h3>",
                    "class" => "text-center ptb60"
                ],
                "component" => "RegularBlock",
                "open" => true,
                "is_container" => false,
            ],
            [
                "type" => "list_featured_item",
                "name" => "List Featured Item",
                "model" => [
                    "list_item" => [
                        ["_active" => false, "title" => "Earn an additional income", "sub_title" => " Ut elit tellus, luctus nec ullamcorper mattis", "icon_image" => $ico_piggy_bank_1, "order" => null],
                        ["_active" => true, "title" => "Open your network", "sub_title" => " Ut elit tellus, luctus nec ullamcorper mattis", "icon_image" => $ico_friendship_1, "order" => null],
                        ["_active" => true, "title" => "Practice your language", "sub_title" => " Ut elit tellus, luctus nec ullamcorper mattis", "icon_image" => $ico_chat_1, "order" => null]
                    ],
                "style" => "style3"
                ],
                "component" => "RegularBlock",
                "open" => true,
                "is_container" => false
            ],
            [
                "type" => "faqs",
                "name" => "FAQ List",
                "model" => [
                    "title" => "FAQs",
                    "list_item" => [
                        ["_active" => false, "title" => "How will I receive my payment?", "sub_title" => " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo."],
                        ["_active" => true, "title" => "How do I upload products?", "sub_title" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo."],
                        ["_active" => true, "title" => "How do I update or extend my availabilities?", "sub_title" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.\n"],
                        ["_active" => true, "title" => "How do I increase conversion rate?", "sub_title" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo."]
                    ]
                ], 
                "component" => "RegularBlock",
                "open" => true,
                "is_container" => false
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
