<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Media\Models\MediaFile;
use Modules\Review\Models\Review;
use Modules\Review\Models\ReviewMeta;
class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $templateId = DB::table('core_templates')->insertGetId([
            'title'       => 'To Mongolia: Event',
            'content'     => json_encode($this->content()),
            'create_user' => '1',
            'created_at'  => date("Y-m-d H:i:s")
        ]);

        if ($templateId) {
            DB::table('core_template_translations')->insert([
                'origin_id'   => $templateId,
                'locale'      => 'ko',
                'title'       => 'To Mongolia: Event',
                'content'     => json_encode($this->contentKorean()),
                'create_user' => '1',
                'created_at'  => date("Y-m-d H:i:s")
            ]);
        }

        DB::table('core_pages')->insert([
            'title'       => 'To Mongolia: Event',
            'slug'        => 'event',
            'template_id' => $templateId,
            'create_user' => '1',
            'status'      => 'publish',
            'created_at'  => date("Y-m-d H:i:s")
        ]);
        
        $list_gallery = [];
        for($i=1 ; $i <=6 ; $i++){
            $list_gallery[] = MediaFile::findMediaByName("gallery-event-".$i)->id;
        }

        $IDs_vendor[] = $create_user =  rand(4,6);
        $IDs[] = DB::table('bravo_events')->insertGetId(
            [
                'title' => 'Northern Lights Event Planners',
                'slug' => Str::slug('Northern Lights Event Planners', '-'),
                'content' => "<p>Start and end in San Francisco! With the in-depth cultural event Northern California Summer 2019, you have a 8 day event package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
                'image_id' => MediaFile::findMediaByName("event-9")->id,
                'banner_image_id' => MediaFile::findMediaByName("banner-event-3")->id,
                'location_id' => 4,
                'address' => "United States",
                'is_featured' => "1",
                'gallery' => implode(",",$list_gallery),
                'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
                'price' => "800",
                'sale_price' => "600",
                'map_lat' => "37.040023",
                'map_lng' => "-95.643144",
                'map_zoom' => "12",
                'duration' => rand(1,9),
                'start_time' => "20:00",
                'faqs' => '[{"title":"Can children come to events?","content":"Unless otherwise stated, children are always welcome, but please be aware that most of our events are aimed at an adult audience.  Children must be supervised at all times."},{"title":"Is there seating at events?","content":"Yes, we always provide a variety of seating for all ticketholders unless it\u2019s a dance event or art show opening.  One of our crew will always be on hand to assist you in finding a seat if you need one."},{"title":"Where can I park?","content":"There is a wide choice of places to park, however most are not free so please do check before you come on the Southampton City Council website.  We have no onsite parking."},{"title":"Are you near public transport?","content":"Very.  There is a bus stop a few doors up and the train station is about 7 minutes gentle walk away."},{"title":"Is it safe to come at night?","content":"To our knowledge, none of our customers has had any bad experience, however we do recommend that if you are worried you stick to the roads rather than walk through the parks.  The roads are well-lit and generally there are a lot of people about at night."},{"title":"Can I come on my own?","content":"YES!  Many of our customers come alone to events, it\u2019s never a problem and you will be welcomed warmly."}]',
                'ticket_types' => '[{"code":"ticket_vip","name":"Ticket Vip","name_ja":"\u30c1\u30b1\u30c3\u30c8VIP","name_egy":null,"price":"1000","number":"10"},{"code":"ticket_group_tickets","name":"Group Tickets","name_ja":"\u30b0\u30eb\u30fc\u30d7\u30c1\u30b1\u30c3\u30c8","name_egy":null,"price":"500","number":"10"}]',
                'status' => "publish",
                'create_user' => $create_user,
                'created_at' =>  date("Y-m-d H:i:s"),
                
            ]
        );
        $IDs_vendor[] = $create_user =  rand(4,6);
        $IDs[] = DB::table('bravo_events')->insertGetId(
            [
                'title' => 'Origami Crane Wedding Planners',
                'slug' => Str::slug('Origami Crane Wedding Planners', '-'),
                'content' => "<p>Start and end in San Francisco! With the in-depth cultural event Northern California Summer 2019, you have a 8 day event package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
                'image_id' => MediaFile::findMediaByName("event-10")->id,
                'banner_image_id' => MediaFile::findMediaByName("banner-event-1")->id,
                'location_id' => 5,
                'address' => "Washington, DC, USA",
                'is_featured' => "0",
                'gallery' => implode(",",$list_gallery),
                'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
                'price' => "400",
                'sale_price' => "",
                'map_lat' => "34.049345",
                'map_lng' => "-118.248479",
                'map_zoom' => "12",
                'duration' => rand(1,9),
                'start_time' => "18:00",
                'faqs' => '[{"title":"Can children come to events?","content":"Unless otherwise stated, children are always welcome, but please be aware that most of our events are aimed at an adult audience.  Children must be supervised at all times."},{"title":"Is there seating at events?","content":"Yes, we always provide a variety of seating for all ticketholders unless it\u2019s a dance event or art show opening.  One of our crew will always be on hand to assist you in finding a seat if you need one."},{"title":"Where can I park?","content":"There is a wide choice of places to park, however most are not free so please do check before you come on the Southampton City Council website.  We have no onsite parking."},{"title":"Are you near public transport?","content":"Very.  There is a bus stop a few doors up and the train station is about 7 minutes gentle walk away."},{"title":"Is it safe to come at night?","content":"To our knowledge, none of our customers has had any bad experience, however we do recommend that if you are worried you stick to the roads rather than walk through the parks.  The roads are well-lit and generally there are a lot of people about at night."},{"title":"Can I come on my own?","content":"YES!  Many of our customers come alone to events, it\u2019s never a problem and you will be welcomed warmly."}]',
                'ticket_types' => '[{"code":"ticket_vip","name":"Ticket Vip","name_ja":"\u30c1\u30b1\u30c3\u30c8VIP","name_egy":null,"price":"1000","number":"10"},{"code":"ticket_group_tickets","name":"Group Tickets","name_ja":"\u30b0\u30eb\u30fc\u30d7\u30c1\u30b1\u30c3\u30c8","name_egy":null,"price":"500","number":"10"}]',
                'status' => "publish",
                'create_user' => $create_user,
                'created_at' =>  date("Y-m-d H:i:s"),
                
            ]
        );
        $IDs_vendor[] = $create_user =  rand(4,6);
        $IDs[] = DB::table('bravo_events')->insertGetId(
            [
                'title' => 'New York – Discover America',
                'slug' => Str::slug('New York – Discover America', '-'),
                'content' => "<p>Start and end in San Francisco! With the in-depth cultural event Northern California Summer 2019, you have a 8 day event package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
                'image_id' => MediaFile::findMediaByName("event-11")->id,
                'banner_image_id' => MediaFile::findMediaByName("banner-event-2")->id,
                'location_id' => 6,
                'address' => "New Jersey",
                'is_featured' => "1",
                'gallery' => implode(",",$list_gallery),
                'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
                'price' => "300",
                'sale_price' => "",
                'map_lat' => "40.035329",
                'map_lng' => "-74.417227",
                'map_zoom' => "12",
                'duration' => rand(1,9),
                'start_time' => "14:00",
                'faqs' => '[{"title":"Can children come to events?","content":"Unless otherwise stated, children are always welcome, but please be aware that most of our events are aimed at an adult audience.  Children must be supervised at all times."},{"title":"Is there seating at events?","content":"Yes, we always provide a variety of seating for all ticketholders unless it\u2019s a dance event or art show opening.  One of our crew will always be on hand to assist you in finding a seat if you need one."},{"title":"Where can I park?","content":"There is a wide choice of places to park, however most are not free so please do check before you come on the Southampton City Council website.  We have no onsite parking."},{"title":"Are you near public transport?","content":"Very.  There is a bus stop a few doors up and the train station is about 7 minutes gentle walk away."},{"title":"Is it safe to come at night?","content":"To our knowledge, none of our customers has had any bad experience, however we do recommend that if you are worried you stick to the roads rather than walk through the parks.  The roads are well-lit and generally there are a lot of people about at night."},{"title":"Can I come on my own?","content":"YES!  Many of our customers come alone to events, it\u2019s never a problem and you will be welcomed warmly."}]',
                'ticket_types' => '[{"code":"ticket_vip","name":"Ticket Vip","name_ja":"\u30c1\u30b1\u30c3\u30c8VIP","name_egy":null,"price":"1000","number":"10"},{"code":"ticket_group_tickets","name":"Group Tickets","name_ja":"\u30b0\u30eb\u30fc\u30d7\u30c1\u30b1\u30c3\u30c8","name_egy":null,"price":"500","number":"10"}]',
                'status' => "publish",
                'create_user' => $create_user,
                'created_at' =>  date("Y-m-d H:i:s"),
                
            ]
        );
        $IDs_vendor[] = $create_user = "1";
        $IDs[] = DB::table('bravo_events')->insertGetId(
            [
                'title' => 'Event of Washington, D.C. Highlights',
                'slug' => Str::slug('Event of Washington, D.C. Highlights', '-'),
                'content' => "<p>Start and end in San Francisco! With the in-depth cultural event Northern California Summer 2019, you have a 8 day event package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
                'image_id' => MediaFile::findMediaByName("event-12")->id,
                'banner_image_id' => MediaFile::findMediaByName("banner-event-3")->id,
                'location_id' => 7,
                'address' => "Francisco Parnassus Campus",
                'is_featured' => "1",
                'gallery' => implode(",",$list_gallery),
                'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
                'price' => "2100",
                'sale_price' => rand(100, 1800),
                'map_lat' => "37.782668",
                'map_lng' => "-122.425058",
                'map_zoom' => "12",
                'duration' => rand(1,9),
                'start_time' => "17:00",
                'faqs' => '[{"title":"Can children come to events?","content":"Unless otherwise stated, children are always welcome, but please be aware that most of our events are aimed at an adult audience.  Children must be supervised at all times."},{"title":"Is there seating at events?","content":"Yes, we always provide a variety of seating for all ticketholders unless it\u2019s a dance event or art show opening.  One of our crew will always be on hand to assist you in finding a seat if you need one."},{"title":"Where can I park?","content":"There is a wide choice of places to park, however most are not free so please do check before you come on the Southampton City Council website.  We have no onsite parking."},{"title":"Are you near public transport?","content":"Very.  There is a bus stop a few doors up and the train station is about 7 minutes gentle walk away."},{"title":"Is it safe to come at night?","content":"To our knowledge, none of our customers has had any bad experience, however we do recommend that if you are worried you stick to the roads rather than walk through the parks.  The roads are well-lit and generally there are a lot of people about at night."},{"title":"Can I come on my own?","content":"YES!  Many of our customers come alone to events, it\u2019s never a problem and you will be welcomed warmly."}]',
                'ticket_types' => '[{"code":"ticket_vip","name":"Ticket Vip","name_ja":"\u30c1\u30b1\u30c3\u30c8VIP","name_egy":null,"price":"1000","number":"10"},{"code":"ticket_group_tickets","name":"Group Tickets","name_ja":"\u30b0\u30eb\u30fc\u30d7\u30c1\u30b1\u30c3\u30c8","name_egy":null,"price":"500","number":"10"}]',
                'status' => "publish",
                'create_user' => $create_user,
                'created_at' =>  date("Y-m-d H:i:s"),
            ]
        );


        // Add meta for event
        foreach ($IDs as $numer_key => $event){
            $vendor_id = $IDs_vendor[$numer_key];
            for ($i = 1 ; $i <= 5 ; $i++){
                if( rand(1,5) == $i) continue;
                if( rand(1,5) == $i) continue;
                $metaReview = [];
                $list_meta = [
                    "Service",
                    "Organization",
                    "Friendliness",
                    "Area Expert",
                    "Safety",
                ];
                $total_point = 0;
                foreach ($list_meta as $key => $value) {
                    $point = rand(4,5);
                    $total_point += $point;
                    $metaReview[] = [
                        "object_id"    => $event,
                        "object_model" => "event",
                        "name"         => $value,
                        "val"          => $point,
                        "create_user"  => "1",
                    ];
                }
                $rate = round($total_point / count($list_meta), 1);
                if ($rate > 5) $rate = 5;
                $titles = ["Great Trip","Good Trip","Trip was great","Easy way to discover the city"];
                $review = new Review([
                    "object_id"    => $event,
                    "object_model" => "event",
                    "title"        => $titles[rand(0, 3)],
                    "content"      => "Eum eu sumo albucius perfecto, commodo torquatos consequuntur pro ut, id posse splendide ius. Cu nisl putent omittantur usu, mutat atomorum ex pro, ius nibh nonumy id. Nam at eius dissentias disputando, molestie mnesarchum complectitur per te",
                    "rate_number"  => $rate,
                    "author_ip"    => "127.0.0.1",
                    "status"       => "approved",
                    "publish_date" => date("Y-m-d H:i:s"),
                    'create_user' => rand(7,16),
                    'vendor_id' => $vendor_id,
                ]);
                if ($review->save()) {
                    if (!empty($metaReview)) {
                        foreach ($metaReview as $meta) {
                            $meta['review_id'] = $review->id;
                            $reviewMeta = new ReviewMeta($meta);
                            $reviewMeta->save();
                        }
                    }
                }
            }
        }

        // Settings Event
        DB::table('core_settings')->insert(
            [
                [
                    'name' => 'event_page_search_title',
                    'val' => 'Search for event',
                    'group' => "event",
                ],
                [
                    'name' => 'event_page_limit_item',
                    'val' => 9,
                    'group' => "event",
                ],
                [
                    'name' => 'event_page_search_banner',
                    'val' => MediaFile::findMediaByName("banner-search-event")->id,
                    'group' => "event",
                ],
                [
                    'name' => 'event_layout_search',
                    'val' => 'normal',
                    'group' => "event",
                ],
                [
                    'name' => 'event_enable_review',
                    'val' => '1',
                    'group' => "event",
                ],
                [
                    'name' => 'event_review_approved',
                    'val' => '0',
                    'group' => "event",
                ],
                [
                    'name' => 'event_review_stats',
                    'val' => '[{"title":"Service"},{"title":"Organization"},{"title":"Friendliness"},{"title":"Area Expert"},{"title":"Safety"}]',
                    'group' => "event",
                ],
                [
                    'name'=>'event_map_search_fields',
                    'val'=>'[{"field":"location","attr":null,"position":"1"},{"field":"category","attr":null,"position":"2"},{"field":"date","attr":null,"position":"3"},{"field":"price","attr":null,"position":"4"},{"field":"advance","attr":null,"position":"5"}]',
                    'group'=>'event'
                ],
                [
                    'name'=>'event_search_fields',
                    'val'=>'[{"title":"Location","field":"location","size":"6","position":"1"},{"title":"From - To","field":"date","size":"6","position":"2"}]',
                    'group'=>'event'
                ]
            ]
        );

        $a = new \Modules\Core\Models\Attributes([
            'name'=>'Event Type',
            'service'=>'event'
        ]);

        $a->save();

        $term_ids = [];
        foreach (['Field Day','Glastonbury','Green Man','Latitude','Boomtown','Wilderness','Exit Festival','Primavera Sound'] as $term){
            $t = new \Modules\Core\Models\Terms([
                'name'=>$term,
                'attr_id'=>$a->id
            ]);
            $t->save();
            $term_ids[] = $t->id;
        }

        foreach ($IDs as $event_id){
            foreach ($term_ids as $k=>$term_id) {
                if( rand(0 , count($term_ids) ) == $k) continue;
                if( rand(0 , count($term_ids) ) == $k) continue;
                if( rand(0 , count($term_ids) ) == $k) continue;
                \Modules\Event\Models\EventTerm::firstOrCreate([
                    'term_id' => $term_id,
                    'target_id' => $event_id
                ]);
            }
        }

        //Update Review Score
        foreach ($IDs as $service_id){
            \Modules\Event\Models\Event::find($service_id)->update_service_rate();
        }
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
                        ["_active" => true, "title" => "Photo", "link" => "/page/photo"],
                        ["_active" => true, "title" => "Show", "link" => "/page/show"],
                        ["_active" => true, "title" => "Museum", "link" => "/page/themuseum"],
                        ["_active" => true, "title" => "Food / Drink", "link" => "/page/drink"],
                        ["_active" => true, "title" => "Light plane", "link" => "/page/plane"],
                    ]
                ]
            ],
            [
                "type" => "list_event",
                "name" => "Event: List Items",
                "model" => [
                    "title" => "Classical Music Event ",
                    "desc" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry",
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
