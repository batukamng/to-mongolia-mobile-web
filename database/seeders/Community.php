<?php
namespace Database\Seeders;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Media\Models\MediaFile;
use Modules\Community\Models\CommunityCategory;

use Modules\Review\Models\Review;
use Modules\Review\Models\ReviewMeta;

class Community extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories =  [
            ['name' => 'City trips', 'content' => '', 'status' => 'publish',],
            ['name' => 'Ecocommunityism', 'content' => '', 'status' => 'publish',],
            ['name' => 'Escorted community', 'content' => '', 'status' => 'publish',],
            ['name' => 'Ligula', 'content' => '', 'status' => 'publish',]
        ];

        foreach ($categories as $category){
            $row = new CommunityCategory( $category );
            $row->save();
        }

        $list_gallery = [];
        for($i=1 ; $i <=7 ; $i++){
            $list_gallery[] = MediaFile::findMediaByName("gallery-".$i)->id;
        }
        $IDs_vendor[] = $create_user =  "1";
        $IDs[] = DB::table('bravo_communitys')->insertGetId(
            [
                'title' => 'American Parks Trail end Rapid City',
                'slug' => 'american-parks-trail',
                'content' => "모집 인원",
                'image_id' => MediaFile::findMediaByName("community-1")->id,
                'banner_image_id' => MediaFile::findMediaByName("banner-community-1")->id,
                'category_id' => rand(1, 4),
                'location_id' => 9,
                'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
                'address' => "Arrondissement de Paris",
                'is_featured' => "0",
                'gallery' => implode(",",$list_gallery),
                'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
                'price' => "2000",
                'sale_price' => rand(100, 800),
                'map_lat' => "48.852754",
                'map_lng' => "2.339155",
                'map_zoom' => "12",
                'duration' => rand(1,9),
                'max_people' => rand(10,20),
                'min_people' =>1,
                'faqs' => '[{"title":"When and where does the community end?","content":"Your community will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the community start?","content":"Day 1 of this community is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this community, however you can book for an arrival transfer in advance. In this case a community operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This community has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this community. However, if you are over 70 years please contact us as you may be eligible to join the community if you fill out G Adventures self-assessment form."}]',
                'status' => "publish",
                'create_user' => $create_user,
                'created_at' =>  date("Y-m-d H:i:s"),
                'include' =>  '[{"title":"Specialized bilingual guide"},{"title":"Private Transport"},{"title":"Entrance fees (Cable and car and Moon Valley)"},{"title":"Box lunch water, banana apple and chocolate"}]',
                'exclude' =>  '[{"title":"Additional Services"},{"title":"Insurance"},{"title":"Drink"},{"title":"Tickets"}]',
                'itinerary' =>  '[{"image_id":"'.MediaFile::findMediaByName("location-5")->id.'","title":"Day 1","desc":"Los Angeles","content":"There are no activities planned until an evening welcome meeting. Additional Notes: We highly recommend booking pre-community accommodation to fully experience this crazy city."},{"image_id":"'.MediaFile::findMediaByName("location-4")->id.'","title":"Day 2","desc":"Lake Havasu City","content":"Pack up the van in the morning and check out the stars on the most famous sidewalk in Hollywood on an orientation community"},{"image_id":"'.MediaFile::findMediaByName("location-3")->id.'","title":"Day 3","desc":"Las Vegas\/Bakersfield","content":"Travel to one of the country\'s most rugged landscapes \u2014 the legendary Death Valley, California. Soak in the dramatic landscape. In the afternoon, continue on to Bakersfield for the night."},{"image_id":"'.MediaFile::findMediaByName("location-2")->id.'","title":"Day 4","desc":"San Francisco","content":"We highly recommend booking post-accommodation to fully experience this famous city."}]',
            ]);
        // $IDs_vendor[] = $create_user =  "1";
        // $IDs[] = DB::table('bravo_communitys')->insertGetId(
        //     [
        //         'title' => 'New York: Museum of Modern Art',
        //         'slug' => Str::slug('New York: Museum of Modern Art', '-'),
        //         'content' => "<p>Start and end in San Francisco! With the in-depth cultural community Northern California Summer 2019, you have a 8 day community package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
        //         'image_id' => MediaFile::findMediaByName("community-2")->id,
        //         'banner_image_id' => MediaFile::findMediaByName("banner-community-2")->id,
        //         'category_id' => rand(1, 4),
        //         'location_id' => 8,
        //         'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
        //         'address' => "Porte de Vanves",
        //         'is_featured' => "1",
        //         'gallery' => implode(",",$list_gallery),
        //         'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
        //         'price' => "900",
        //         'sale_price' => rand(100, 800),
        //         'map_lat' => "48.853917",
        //         'map_lng' => "2.307199",
        //         'map_zoom' => "12",
        //         'duration' => rand(1,9),
        //         'max_people' => rand(10,20),
        //         'min_people' =>1,
        //         'faqs' => '[{"title":"When and where does the community end?","content":"Your community will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the community start?","content":"Day 1 of this community is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this community, however you can book for an arrival transfer in advance. In this case a community operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This community has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this community. However, if you are over 70 years please contact us as you may be eligible to join the community if you fill out G Adventures self-assessment form."}]',
        //         'status' => "publish",
        //         'create_user' => $create_user,
        //         'created_at' =>  date("Y-m-d H:i:s"),
        //         'include' =>  '[{"title":"Specialized bilingual guide"},{"title":"Private Transport"},{"title":"Entrance fees (Cable and car and Moon Valley)"},{"title":"Box lunch water, banana apple and chocolate"}]',
        //         'exclude' =>  '[{"title":"Additional Services"},{"title":"Insurance"},{"title":"Drink"},{"title":"Tickets"}]',
        //         'itinerary' =>  '[{"image_id":"'.MediaFile::findMediaByName("location-5")->id.'","title":"Day 1","desc":"Los Angeles","content":"There are no activities planned until an evening welcome meeting. Additional Notes: We highly recommend booking pre-community accommodation to fully experience this crazy city."},{"image_id":"'.MediaFile::findMediaByName("location-4")->id.'","title":"Day 2","desc":"Lake Havasu City","content":"Pack up the van in the morning and check out the stars on the most famous sidewalk in Hollywood on an orientation community"},{"image_id":"'.MediaFile::findMediaByName("location-3")->id.'","title":"Day 3","desc":"Las Vegas\/Bakersfield","content":"Travel to one of the country\'s most rugged landscapes \u2014 the legendary Death Valley, California. Soak in the dramatic landscape. In the afternoon, continue on to Bakersfield for the night."},{"image_id":"'.MediaFile::findMediaByName("location-2")->id.'","title":"Day 4","desc":"San Francisco","content":"We highly recommend booking post-accommodation to fully experience this famous city."}]',
        //     ]);
        // $IDs_vendor[] = $create_user =  rand(4,6);
        // $IDs[] = DB::table('bravo_communitys')->insertGetId(
        //     [
        //         'title' => 'Los Angeles to San Francisco Express ',
        //         'slug' => Str::slug('Los Angeles to San Francisco Express', '-'),
        //         'content' => "<p>Start and end in San Francisco! With the in-depth cultural community Northern California Summer 2019, you have a 8 day community package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
        //         'image_id' => MediaFile::findMediaByName("community-3")->id,
        //         'banner_image_id' => MediaFile::findMediaByName("banner-community-3")->id,
        //         'category_id' => rand(1, 4),
        //         'location_id' => 6,
        //         'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
        //         'address' => "Petit-Montrouge",
        //         'is_featured' => "1",
        //         'gallery' => implode(",",$list_gallery),
        //         'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
        //         'price' => "1500",
        //         'sale_price' => rand(100, 800),
        //         'map_lat' => "48.884900",
        //         'map_lng' => "2.346377",
        //         'map_zoom' => "12",
        //         'duration' => rand(1,9),
        //         'max_people' => rand(10,20),
        //         'min_people' =>1,
        //         'faqs' => '[{"title":"When and where does the community end?","content":"Your community will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the community start?","content":"Day 1 of this community is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this community, however you can book for an arrival transfer in advance. In this case a community operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This community has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this community. However, if you are over 70 years please contact us as you may be eligible to join the community if you fill out G Adventures self-assessment form."}]',
        //         'status' => "publish",
        //         'create_user' => $create_user,
        //         'created_at' =>  date("Y-m-d H:i:s"),
        //         'include' =>  '[{"title":"Specialized bilingual guide"},{"title":"Private Transport"},{"title":"Entrance fees (Cable and car and Moon Valley)"},{"title":"Box lunch water, banana apple and chocolate"}]',
        //         'exclude' =>  '[{"title":"Additional Services"},{"title":"Insurance"},{"title":"Drink"},{"title":"Tickets"}]',
        //         'itinerary' =>  '[{"image_id":"'.MediaFile::findMediaByName("location-5")->id.'","title":"Day 1","desc":"Los Angeles","content":"There are no activities planned until an evening welcome meeting. Additional Notes: We highly recommend booking pre-community accommodation to fully experience this crazy city."},{"image_id":"'.MediaFile::findMediaByName("location-4")->id.'","title":"Day 2","desc":"Lake Havasu City","content":"Pack up the van in the morning and check out the stars on the most famous sidewalk in Hollywood on an orientation community"},{"image_id":"'.MediaFile::findMediaByName("location-3")->id.'","title":"Day 3","desc":"Las Vegas\/Bakersfield","content":"Travel to one of the country\'s most rugged landscapes \u2014 the legendary Death Valley, California. Soak in the dramatic landscape. In the afternoon, continue on to Bakersfield for the night."},{"image_id":"'.MediaFile::findMediaByName("location-2")->id.'","title":"Day 4","desc":"San Francisco","content":"We highly recommend booking post-accommodation to fully experience this famous city."}]',
        //     ]);
        // $IDs_vendor[] = $create_user =  "1";
        // $IDs[] = DB::table('bravo_communitys')->insertGetId(
        //     [
        //         'title' => 'Paris Vacation Travel ',
        //         'slug' => Str::slug('Paris Vacation Travel ', '-'),
        //         'content' => "<p>Start and end in San Francisco! With the in-depth cultural community Northern California Summer 2019, you have a 8 day community package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
        //         'image_id' => MediaFile::findMediaByName("community-4")->id,
        //         'banner_image_id' => MediaFile::findMediaByName("banner-community-4")->id,
        //         'category_id' => rand(1, 4),
        //         'location_id' => 7 ,
        //         'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
        //         'address' => "New York",
        //         'is_featured' => "1",
        //         'gallery' => implode(",",$list_gallery),
        //         'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
        //         'price' => "850",
        //         'sale_price' => rand(100, 800),
        //         'map_lat' => "40.707891",
        //         'map_lng' => "-74.008825",
        //         'map_zoom' => "12",
        //         'duration' => rand(1,9),
        //         'max_people' => rand(10,20),
        //         'min_people' =>1,
        //         'faqs' => '[{"title":"When and where does the community end?","content":"Your community will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the community start?","content":"Day 1 of this community is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this community, however you can book for an arrival transfer in advance. In this case a community operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This community has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this community. However, if you are over 70 years please contact us as you may be eligible to join the community if you fill out G Adventures self-assessment form."}]',
        //         'status' => "publish",
        //         'create_user' => $create_user,
        //         'created_at' =>  date("Y-m-d H:i:s"),
        //         'include' =>  '[{"title":"Specialized bilingual guide"},{"title":"Private Transport"},{"title":"Entrance fees (Cable and car and Moon Valley)"},{"title":"Box lunch water, banana apple and chocolate"}]',
        //         'exclude' =>  '[{"title":"Additional Services"},{"title":"Insurance"},{"title":"Drink"},{"title":"Tickets"}]',
        //         'itinerary' =>  '[{"image_id":"'.MediaFile::findMediaByName("location-5")->id.'","title":"Day 1","desc":"Los Angeles","content":"There are no activities planned until an evening welcome meeting. Additional Notes: We highly recommend booking pre-community accommodation to fully experience this crazy city."},{"image_id":"'.MediaFile::findMediaByName("location-4")->id.'","title":"Day 2","desc":"Lake Havasu City","content":"Pack up the van in the morning and check out the stars on the most famous sidewalk in Hollywood on an orientation community"},{"image_id":"'.MediaFile::findMediaByName("location-3")->id.'","title":"Day 3","desc":"Las Vegas\/Bakersfield","content":"Travel to one of the country\'s most rugged landscapes \u2014 the legendary Death Valley, California. Soak in the dramatic landscape. In the afternoon, continue on to Bakersfield for the night."},{"image_id":"'.MediaFile::findMediaByName("location-2")->id.'","title":"Day 4","desc":"San Francisco","content":"We highly recommend booking post-accommodation to fully experience this famous city."}]',
        //     ]);
        // $IDs_vendor[] = $create_user =  rand(4,6);
        // $IDs[] = DB::table('bravo_communitys')->insertGetId(
        //     [
        //         'title' => 'Southwest States (Ex Los Angeles) ',
        //         'slug' => Str::slug('Southwest States', '-'),
        //         'content' => "<p>Start and end in San Francisco! With the in-depth cultural community Northern California Summer 2019, you have a 8 day community package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
        //         'image_id' => MediaFile::findMediaByName("community-5")->id,
        //         'banner_image_id' => MediaFile::findMediaByName("banner-community-5")->id,
        //         'category_id' => rand(1, 4),
        //         'location_id' => 2 ,
        //         'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
        //         'address' => "Regal Cinemas Battery Park 11",
        //         'is_featured' => "0",
        //         'gallery' => implode(",",$list_gallery),
        //         'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
        //         'price' => "1900",
        //         'sale_price' => rand(100, 1800),
        //         'map_lat' => "40.714578",
        //         'map_lng' => "-73.983888",
        //         'map_zoom' => "12",
        //         'duration' => rand(1,9),
        //         'max_people' => rand(10,20),
        //         'min_people' =>1,
        //         'faqs' => '[{"title":"When and where does the community end?","content":"Your community will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the community start?","content":"Day 1 of this community is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this community, however you can book for an arrival transfer in advance. In this case a community operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This community has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this community. However, if you are over 70 years please contact us as you may be eligible to join the community if you fill out G Adventures self-assessment form."}]',
        //         'status' => "publish",
        //         'create_user' => $create_user,
        //         'created_at' =>  date("Y-m-d H:i:s"),
        //         'include' =>  '[{"title":"Specialized bilingual guide"},{"title":"Private Transport"},{"title":"Entrance fees (Cable and car and Moon Valley)"},{"title":"Box lunch water, banana apple and chocolate"}]',
        //         'exclude' =>  '[{"title":"Additional Services"},{"title":"Insurance"},{"title":"Drink"},{"title":"Tickets"}]',
        //         'itinerary' =>  '[{"image_id":"'.MediaFile::findMediaByName("location-5")->id.'","title":"Day 1","desc":"Los Angeles","content":"There are no activities planned until an evening welcome meeting. Additional Notes: We highly recommend booking pre-community accommodation to fully experience this crazy city."},{"image_id":"'.MediaFile::findMediaByName("location-4")->id.'","title":"Day 2","desc":"Lake Havasu City","content":"Pack up the van in the morning and check out the stars on the most famous sidewalk in Hollywood on an orientation community"},{"image_id":"'.MediaFile::findMediaByName("location-3")->id.'","title":"Day 3","desc":"Las Vegas\/Bakersfield","content":"Travel to one of the country\'s most rugged landscapes \u2014 the legendary Death Valley, California. Soak in the dramatic landscape. In the afternoon, continue on to Bakersfield for the night."},{"image_id":"'.MediaFile::findMediaByName("location-2")->id.'","title":"Day 4","desc":"San Francisco","content":"We highly recommend booking post-accommodation to fully experience this famous city."}]',
        //     ]);
        // $IDs_vendor[] = $create_user =  rand(4,6);
        // $IDs[] = DB::table('bravo_communitys')->insertGetId(
        //     [
        //         'title' => 'Eastern Discovery (Start New Orleans)',
        //         'slug' => Str::slug('Eastern Discovery (Start New Orleans)', '-'),
        //         'content' => "<p>Start and end in San Francisco! With the in-depth cultural community Northern California Summer 2019, you have a 8 day community package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
        //         'image_id' => MediaFile::findMediaByName("community-6")->id,
        //         'banner_image_id' => MediaFile::findMediaByName("banner-community-6")->id,
        //         'category_id' => rand(1, 4),
        //         'location_id' => 2,
        //         'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
        //         'address' => "Prince St Station",
        //         'is_featured' => "1",
        //         'gallery' => implode(",",$list_gallery),
        //         'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
        //         'price' => "2100",
        //         'sale_price' => rand(100, 1800),
        //         'map_lat' => "40.720161",
        //         'map_lng' => "-74.009628",
        //         'map_zoom' => "12",
        //         'duration' => rand(1,9),
        //         'max_people' => rand(10,20),
        //         'min_people' =>1,
        //         'faqs' => '[{"title":"When and where does the community end?","content":"Your community will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the community start?","content":"Day 1 of this community is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this community, however you can book for an arrival transfer in advance. In this case a community operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This community has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this community. However, if you are over 70 years please contact us as you may be eligible to join the community if you fill out G Adventures self-assessment form."}]',
        //         'status' => "publish",
        //         'create_user' => $create_user,
        //         'created_at' =>  date("Y-m-d H:i:s"),
        //         'include' =>  '[{"title":"Specialized bilingual guide"},{"title":"Private Transport"},{"title":"Entrance fees (Cable and car and Moon Valley)"},{"title":"Box lunch water, banana apple and chocolate"}]',
        //         'exclude' =>  '[{"title":"Additional Services"},{"title":"Insurance"},{"title":"Drink"},{"title":"Tickets"}]',
        //         'itinerary' =>  '[{"image_id":"'.MediaFile::findMediaByName("location-5")->id.'","title":"Day 1","desc":"Los Angeles","content":"There are no activities planned until an evening welcome meeting. Additional Notes: We highly recommend booking pre-community accommodation to fully experience this crazy city."},{"image_id":"'.MediaFile::findMediaByName("location-4")->id.'","title":"Day 2","desc":"Lake Havasu City","content":"Pack up the van in the morning and check out the stars on the most famous sidewalk in Hollywood on an orientation community"},{"image_id":"'.MediaFile::findMediaByName("location-3")->id.'","title":"Day 3","desc":"Las Vegas\/Bakersfield","content":"Travel to one of the country\'s most rugged landscapes \u2014 the legendary Death Valley, California. Soak in the dramatic landscape. In the afternoon, continue on to Bakersfield for the night."},{"image_id":"'.MediaFile::findMediaByName("location-2")->id.'","title":"Day 4","desc":"San Francisco","content":"We highly recommend booking post-accommodation to fully experience this famous city."}]',
        //     ]
        // );
        // $IDs_vendor[] = $create_user =  rand(4,6);
        // $IDs[] = DB::table('bravo_communitys')->insertGetId(
        //     [
        //         'title' => 'Eastern Discovery',
        //         'slug' => Str::slug('Eastern Discovery', '-'),
        //         'content' => "<p>Start and end in San Francisco! With the in-depth cultural community Northern California Summer 2019, you have a 8 day community package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
        //         'image_id' => MediaFile::findMediaByName("community-7")->id,
        //         'banner_image_id' => MediaFile::findMediaByName("banner-community-7")->id,
        //         'category_id' => rand(1, 4),
        //         'location_id' => 2,
        //         'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
        //         'address' => "Pier 36 New York",
        //         'is_featured' => "0",
        //         'gallery' => implode(",",$list_gallery),
        //         'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
        //         'price' => "2100",
        //         'sale_price' => rand(100, 1800),
        //         'map_lat' => "40.708581",
        //         'map_lng' => "-73.998817",
        //         'map_zoom' => "12",
        //         'duration' => rand(1,9),
        //         'max_people' => rand(10,20),
        //         'min_people' =>1,
        //         'faqs' => '[{"title":"When and where does the community end?","content":"Your community will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the community start?","content":"Day 1 of this community is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this community, however you can book for an arrival transfer in advance. In this case a community operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This community has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this community. However, if you are over 70 years please contact us as you may be eligible to join the community if you fill out G Adventures self-assessment form."}]',
        //         'status' => "publish",
        //         'create_user' => $create_user,
        //         'created_at' =>  date("Y-m-d H:i:s"),
        //         'include' =>  '[{"title":"Specialized bilingual guide"},{"title":"Private Transport"},{"title":"Entrance fees (Cable and car and Moon Valley)"},{"title":"Box lunch water, banana apple and chocolate"}]',
        //         'exclude' =>  '[{"title":"Additional Services"},{"title":"Insurance"},{"title":"Drink"},{"title":"Tickets"}]',
        //         'itinerary' =>  '[{"image_id":"'.MediaFile::findMediaByName("location-5")->id.'","title":"Day 1","desc":"Los Angeles","content":"There are no activities planned until an evening welcome meeting. Additional Notes: We highly recommend booking pre-community accommodation to fully experience this crazy city."},{"image_id":"'.MediaFile::findMediaByName("location-4")->id.'","title":"Day 2","desc":"Lake Havasu City","content":"Pack up the van in the morning and check out the stars on the most famous sidewalk in Hollywood on an orientation community"},{"image_id":"'.MediaFile::findMediaByName("location-3")->id.'","title":"Day 3","desc":"Las Vegas\/Bakersfield","content":"Travel to one of the country\'s most rugged landscapes \u2014 the legendary Death Valley, California. Soak in the dramatic landscape. In the afternoon, continue on to Bakersfield for the night."},{"image_id":"'.MediaFile::findMediaByName("location-2")->id.'","title":"Day 4","desc":"San Francisco","content":"We highly recommend booking post-accommodation to fully experience this famous city."}]',
        //     ]
        // );
        // $IDs_vendor[] = $create_user =  rand(4,6);
        // $IDs[] = DB::table('bravo_communitys')->insertGetId(
        //     [
        //         'title' => 'Pure Luxe in Punta Mita',
        //         'slug' => Str::slug('Pure Luxe in Punta Mita', '-'),
        //         'content' => "<p>Start and end in San Francisco! With the in-depth cultural community Northern California Summer 2019, you have a 8 day community package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
        //         'image_id' => MediaFile::findMediaByName("community-8")->id,
        //         'banner_image_id' => MediaFile::findMediaByName("banner-community-8")->id,
        //         'category_id' => rand(1, 4),
        //         'location_id' => 3,
        //         'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
        //         'address' => "Trimmer Springs Rd, Sanger",
        //         'is_featured' => "0",
        //         'gallery' => implode(",",$list_gallery),
        //         'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
        //         'price' => "2100",
        //         'sale_price' => rand(100, 1800),
        //         'map_lat' => "36.822484",
        //         'map_lng' => "-119.365266",
        //         'map_zoom' => "12",
        //         'duration' => rand(1,9),
        //         'max_people' => rand(10,20),
        //         'min_people' =>1,
        //         'faqs' => '[{"title":"When and where does the community end?","content":"Your community will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the community start?","content":"Day 1 of this community is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this community, however you can book for an arrival transfer in advance. In this case a community operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This community has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this community. However, if you are over 70 years please contact us as you may be eligible to join the community if you fill out G Adventures self-assessment form."}]',
        //         'status' => "publish",
        //         'create_user' => $create_user,
        //         'created_at' =>  date("Y-m-d H:i:s"),
        //         'include' =>  '[{"title":"Specialized bilingual guide"},{"title":"Private Transport"},{"title":"Entrance fees (Cable and car and Moon Valley)"},{"title":"Box lunch water, banana apple and chocolate"}]',
        //         'exclude' =>  '[{"title":"Additional Services"},{"title":"Insurance"},{"title":"Drink"},{"title":"Tickets"}]',
        //         'itinerary' =>  '[{"image_id":"'.MediaFile::findMediaByName("location-5")->id.'","title":"Day 1","desc":"Los Angeles","content":"There are no activities planned until an evening welcome meeting. Additional Notes: We highly recommend booking pre-community accommodation to fully experience this crazy city."},{"image_id":"'.MediaFile::findMediaByName("location-4")->id.'","title":"Day 2","desc":"Lake Havasu City","content":"Pack up the van in the morning and check out the stars on the most famous sidewalk in Hollywood on an orientation community"},{"image_id":"'.MediaFile::findMediaByName("location-3")->id.'","title":"Day 3","desc":"Las Vegas\/Bakersfield","content":"Travel to one of the country\'s most rugged landscapes \u2014 the legendary Death Valley, California. Soak in the dramatic landscape. In the afternoon, continue on to Bakersfield for the night."},{"image_id":"'.MediaFile::findMediaByName("location-2")->id.'","title":"Day 4","desc":"San Francisco","content":"We highly recommend booking post-accommodation to fully experience this famous city."}]',
        //     ]
        // );
        // $IDs_vendor[] = $create_user =  rand(4,6);
        // $IDs[] = DB::table('bravo_communitys')->insertGetId(
        //     [
        //         'title' => 'Tastes and Sounds of the South 2019',
        //         'slug' => Str::slug('Tastes and Sounds of the South 2019', '-'),
        //         'content' => "<p>Start and end in San Francisco! With the in-depth cultural community Northern California Summer 2019, you have a 8 day community package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
        //         'image_id' => MediaFile::findMediaByName("community-9")->id,
        //         'banner_image_id' => MediaFile::findMediaByName("banner-community-9")->id,
        //         'category_id' => rand(1, 4),
        //         'location_id' => 4,
        //         'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
        //         'address' => "United States",
        //         'is_featured' => "0",
        //         'gallery' => implode(",",$list_gallery),
        //         'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
        //         'price' => "2100",
        //         'sale_price' => rand(100, 1800),
        //         'map_lat' => "37.040023",
        //         'map_lng' => "-95.643144",
        //         'map_zoom' => "12",
        //         'duration' => rand(1,9),
        //         'max_people' => rand(10,20),
        //         'min_people' =>1,
        //         'faqs' => '[{"title":"When and where does the community end?","content":"Your community will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the community start?","content":"Day 1 of this community is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this community, however you can book for an arrival transfer in advance. In this case a community operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This community has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this community. However, if you are over 70 years please contact us as you may be eligible to join the community if you fill out G Adventures self-assessment form."}]',
        //         'status' => "publish",
        //         'create_user' => $create_user,
        //         'created_at' =>  date("Y-m-d H:i:s"),
        //         'include' =>  '[{"title":"Specialized bilingual guide"},{"title":"Private Transport"},{"title":"Entrance fees (Cable and car and Moon Valley)"},{"title":"Box lunch water, banana apple and chocolate"}]',
        //         'exclude' =>  '[{"title":"Additional Services"},{"title":"Insurance"},{"title":"Drink"},{"title":"Tickets"}]',
        //         'itinerary' =>  '[{"image_id":"'.MediaFile::findMediaByName("location-5")->id.'","title":"Day 1","desc":"Los Angeles","content":"There are no activities planned until an evening welcome meeting. Additional Notes: We highly recommend booking pre-community accommodation to fully experience this crazy city."},{"image_id":"'.MediaFile::findMediaByName("location-4")->id.'","title":"Day 2","desc":"Lake Havasu City","content":"Pack up the van in the morning and check out the stars on the most famous sidewalk in Hollywood on an orientation community"},{"image_id":"'.MediaFile::findMediaByName("location-3")->id.'","title":"Day 3","desc":"Las Vegas\/Bakersfield","content":"Travel to one of the country\'s most rugged landscapes \u2014 the legendary Death Valley, California. Soak in the dramatic landscape. In the afternoon, continue on to Bakersfield for the night."},{"image_id":"'.MediaFile::findMediaByName("location-2")->id.'","title":"Day 4","desc":"San Francisco","content":"We highly recommend booking post-accommodation to fully experience this famous city."}]',
        //     ]
        // );
        // $IDs_vendor[] = $create_user =  rand(4,6);
        // $IDs[] = DB::table('bravo_communitys')->insertGetId(
        //     [
        //         'title' => 'Giverny and Versailles Small Group Day Trip',
        //         'slug' => Str::slug('Giverny and Versailles Small Group Day Trip', '-'),
        //         'content' => "<p>Start and end in San Francisco! With the in-depth cultural community Northern California Summer 2019, you have a 8 day community package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
        //         'image_id' => MediaFile::findMediaByName("community-10")->id,
        //         'banner_image_id' => MediaFile::findMediaByName("banner-community-10")->id,
        //         'category_id' => rand(1, 4),
        //         'location_id' => 5,
        //         'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
        //         'address' => "Washington, DC, USA",
        //         'is_featured' => "0",
        //         'gallery' => implode(",",$list_gallery),
        //         'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
        //         'price' => "2100",
        //         'sale_price' => rand(100, 1800),
        //         'map_lat' => "34.049345",
        //         'map_lng' => "-118.248479",
        //         'map_zoom' => "12",
        //         'duration' => rand(1,9),
        //         'max_people' => rand(10,20),
        //         'min_people' =>1,
        //         'faqs' => '[{"title":"When and where does the community end?","content":"Your community will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the community start?","content":"Day 1 of this community is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this community, however you can book for an arrival transfer in advance. In this case a community operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This community has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this community. However, if you are over 70 years please contact us as you may be eligible to join the community if you fill out G Adventures self-assessment form."}]',
        //         'status' => "publish",
        //         'create_user' => $create_user,
        //         'created_at' =>  date("Y-m-d H:i:s"),
        //         'include' =>  '[{"title":"Specialized bilingual guide"},{"title":"Private Transport"},{"title":"Entrance fees (Cable and car and Moon Valley)"},{"title":"Box lunch water, banana apple and chocolate"}]',
        //         'exclude' =>  '[{"title":"Additional Services"},{"title":"Insurance"},{"title":"Drink"},{"title":"Tickets"}]',
        //         'itinerary' =>  '[{"image_id":"'.MediaFile::findMediaByName("location-5")->id.'","title":"Day 1","desc":"Los Angeles","content":"There are no activities planned until an evening welcome meeting. Additional Notes: We highly recommend booking pre-community accommodation to fully experience this crazy city."},{"image_id":"'.MediaFile::findMediaByName("location-4")->id.'","title":"Day 2","desc":"Lake Havasu City","content":"Pack up the van in the morning and check out the stars on the most famous sidewalk in Hollywood on an orientation community"},{"image_id":"'.MediaFile::findMediaByName("location-3")->id.'","title":"Day 3","desc":"Las Vegas\/Bakersfield","content":"Travel to one of the country\'s most rugged landscapes \u2014 the legendary Death Valley, California. Soak in the dramatic landscape. In the afternoon, continue on to Bakersfield for the night."},{"image_id":"'.MediaFile::findMediaByName("location-2")->id.'","title":"Day 4","desc":"San Francisco","content":"We highly recommend booking post-accommodation to fully experience this famous city."}]',
        //     ]
        // );
        // $IDs_vendor[] = $create_user =  rand(4,6);
        // $IDs[] = DB::table('bravo_communitys')->insertGetId(
        //     [
        //         'title' => 'Trip of New York – Discover America',
        //         'slug' => Str::slug('Trip of New York – Discover America', '-'),
        //         'content' => "<p>Start and end in San Francisco! With the in-depth cultural community Northern California Summer 2019, you have a 8 day community package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
        //         'image_id' => MediaFile::findMediaByName("community-11")->id,
        //         'banner_image_id' => MediaFile::findMediaByName("banner-community-11")->id,
        //         'category_id' => rand(1, 4),
        //         'location_id' => 6,
        //         'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
        //         'address' => "New Jersey",
        //         'is_featured' => "0",
        //         'gallery' => implode(",",$list_gallery),
        //         'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
        //         'price' => "2100",
        //         'sale_price' => rand(100, 1800),
        //         'map_lat' => "40.035329",
        //         'map_lng' => "-74.417227",
        //         'map_zoom' => "12",
        //         'duration' => rand(1,9),
        //         'max_people' => rand(10,20),
        //         'min_people' =>1,
        //         'faqs' => '[{"title":"When and where does the community end?","content":"Your community will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the community start?","content":"Day 1 of this community is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this community, however you can book for an arrival transfer in advance. In this case a community operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This community has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this community. However, if you are over 70 years please contact us as you may be eligible to join the community if you fill out G Adventures self-assessment form."}]',
        //         'status' => "publish",
        //         'create_user' => $create_user,
        //         'created_at' =>  date("Y-m-d H:i:s"),
        //         'include' =>  '[{"title":"Specialized bilingual guide"},{"title":"Private Transport"},{"title":"Entrance fees (Cable and car and Moon Valley)"},{"title":"Box lunch water, banana apple and chocolate"}]',
        //         'exclude' =>  '[{"title":"Additional Services"},{"title":"Insurance"},{"title":"Drink"},{"title":"Tickets"}]',
        //         'itinerary' =>  '[{"image_id":"'.MediaFile::findMediaByName("location-5")->id.'","title":"Day 1","desc":"Los Angeles","content":"There are no activities planned until an evening welcome meeting. Additional Notes: We highly recommend booking pre-community accommodation to fully experience this crazy city."},{"image_id":"'.MediaFile::findMediaByName("location-4")->id.'","title":"Day 2","desc":"Lake Havasu City","content":"Pack up the van in the morning and check out the stars on the most famous sidewalk in Hollywood on an orientation community"},{"image_id":"'.MediaFile::findMediaByName("location-3")->id.'","title":"Day 3","desc":"Las Vegas\/Bakersfield","content":"Travel to one of the country\'s most rugged landscapes \u2014 the legendary Death Valley, California. Soak in the dramatic landscape. In the afternoon, continue on to Bakersfield for the night."},{"image_id":"'.MediaFile::findMediaByName("location-2")->id.'","title":"Day 4","desc":"San Francisco","content":"We highly recommend booking post-accommodation to fully experience this famous city."}]',
        //     ]
        // );
        // $IDs_vendor[] = $create_user = "1";
        // $IDs[] = DB::table('bravo_communitys')->insertGetId(
        //     [
        //         'title' => 'Segway Community of Washington, D.C. Highlights',
        //         'slug' => Str::slug('Segway Community of Washington, D.C. Highlights', '-'),
        //         'content' => "<p>Start and end in San Francisco! With the in-depth cultural community Northern California Summer 2019, you have a 8 day community package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
        //         'image_id' => MediaFile::findMediaByName("community-12")->id,
        //         'banner_image_id' => MediaFile::findMediaByName("banner-community-12")->id,
        //         'category_id' => rand(1, 4),
        //         'location_id' => 7,
        //         'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
        //         'address' => "Francisco Parnassus Campus",
        //         'is_featured' => "0",
        //         'gallery' => implode(",",$list_gallery),
        //         'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
        //         'price' => "2100",
        //         'sale_price' => rand(100, 1800),
        //         'map_lat' => "37.782668",
        //         'map_lng' => "-122.425058",
        //         'map_zoom' => "12",
        //         'duration' => rand(1,9),
        //         'max_people' => rand(10,20),
        //         'min_people' =>1,
        //         'faqs' => '[{"title":"When and where does the community end?","content":"Your community will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the community start?","content":"Day 1 of this community is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this community, however you can book for an arrival transfer in advance. In this case a community operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This community has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this community. However, if you are over 70 years please contact us as you may be eligible to join the community if you fill out G Adventures self-assessment form."}]',
        //         'status' => "publish",
        //         'create_user' => $create_user,
        //         'created_at' =>  date("Y-m-d H:i:s"),
        //         'include' =>  '[{"title":"Specialized bilingual guide"},{"title":"Private Transport"},{"title":"Entrance fees (Cable and car and Moon Valley)"},{"title":"Box lunch water, banana apple and chocolate"}]',
        //         'exclude' =>  '[{"title":"Additional Services"},{"title":"Insurance"},{"title":"Drink"},{"title":"Tickets"}]',
        //         'itinerary' =>  '[{"image_id":"'.MediaFile::findMediaByName("location-5")->id.'","title":"Day 1","desc":"Los Angeles","content":"There are no activities planned until an evening welcome meeting. Additional Notes: We highly recommend booking pre-community accommodation to fully experience this crazy city."},{"image_id":"'.MediaFile::findMediaByName("location-4")->id.'","title":"Day 2","desc":"Lake Havasu City","content":"Pack up the van in the morning and check out the stars on the most famous sidewalk in Hollywood on an orientation community"},{"image_id":"'.MediaFile::findMediaByName("location-3")->id.'","title":"Day 3","desc":"Las Vegas\/Bakersfield","content":"Travel to one of the country\'s most rugged landscapes \u2014 the legendary Death Valley, California. Soak in the dramatic landscape. In the afternoon, continue on to Bakersfield for the night."},{"image_id":"'.MediaFile::findMediaByName("location-2")->id.'","title":"Day 4","desc":"San Francisco","content":"We highly recommend booking post-accommodation to fully experience this famous city."}]',
        //     ]
        // );
        // $IDs_vendor[] = $create_user =  rand(4,6);
        // $IDs[] = DB::table('bravo_communitys')->insertGetId(
        //     [
        //         'title' => 'Hollywood Sign Small Group Community in Luxury Van',
        //         'slug' => Str::slug('Hollywood Sign Small Group Community in Luxury Van', '-'),
        //         'content' => "<p>Start and end in San Francisco! With the in-depth cultural community Northern California Summer 2019, you have a 8 day community package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
        //         'image_id' => MediaFile::findMediaByName("community-13")->id,
        //         'banner_image_id' => MediaFile::findMediaByName("banner-community-13")->id,
        //         'category_id' => rand(1, 4),
        //         'location_id' => 8,
        //         'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
        //         'address' => "Virginia",
        //         'is_featured' => "0",
        //         'gallery' => implode(",",$list_gallery),
        //         'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
        //         'price' => "2100",
        //         'sale_price' => rand(100, 1800),
        //         'map_lat' => "37.445688",
        //         'map_lng' => "-78.673668",
        //         'map_zoom' => "12",
        //         'duration' => rand(1,9),
        //         'max_people' => rand(10,20),
        //         'min_people' =>1,
        //         'faqs' => '[{"title":"When and where does the community end?","content":"Your community will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the community start?","content":"Day 1 of this community is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this community, however you can book for an arrival transfer in advance. In this case a community operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This community has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this community. However, if you are over 70 years please contact us as you may be eligible to join the community if you fill out G Adventures self-assessment form."}]',
        //         'status' => "publish",
        //         'create_user' => $create_user,
        //         'created_at' =>  date("Y-m-d H:i:s"),
        //         'include' =>  '[{"title":"Specialized bilingual guide"},{"title":"Private Transport"},{"title":"Entrance fees (Cable and car and Moon Valley)"},{"title":"Box lunch water, banana apple and chocolate"}]',
        //         'exclude' =>  '[{"title":"Additional Services"},{"title":"Insurance"},{"title":"Drink"},{"title":"Tickets"}]',
        //         'itinerary' =>  '[{"image_id":"'.MediaFile::findMediaByName("location-5")->id.'","title":"Day 1","desc":"Los Angeles","content":"There are no activities planned until an evening welcome meeting. Additional Notes: We highly recommend booking pre-community accommodation to fully experience this crazy city."},{"image_id":"'.MediaFile::findMediaByName("location-4")->id.'","title":"Day 2","desc":"Lake Havasu City","content":"Pack up the van in the morning and check out the stars on the most famous sidewalk in Hollywood on an orientation community"},{"image_id":"'.MediaFile::findMediaByName("location-3")->id.'","title":"Day 3","desc":"Las Vegas\/Bakersfield","content":"Travel to one of the country\'s most rugged landscapes \u2014 the legendary Death Valley, California. Soak in the dramatic landscape. In the afternoon, continue on to Bakersfield for the night."},{"image_id":"'.MediaFile::findMediaByName("location-2")->id.'","title":"Day 4","desc":"San Francisco","content":"We highly recommend booking post-accommodation to fully experience this famous city."}]',
        //     ]
        // );
        // $IDs_vendor[] = $create_user =  "1";
        // $IDs[] = DB::table('bravo_communitys')->insertGetId(
        //     [
        //         'title' => 'San Francisco Express Never Ceases',
        //         'slug' => Str::slug('San Francisco Express', '-'),
        //         'content' => "<p>Start and end in San Francisco! With the in-depth cultural community Northern California Summer 2019, you have a 8 day community package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
        //         'image_id' => MediaFile::findMediaByName("community-14")->id,
        //         'banner_image_id' => MediaFile::findMediaByName("banner-community-14")->id,
        //         'category_id' => rand(1, 4),
        //         'location_id' => 7,
        //         'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
        //         'address' => "Comprehensive Cancer Center",
        //         'is_featured' => "0",
        //         'gallery' => implode(",",$list_gallery),
        //         'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
        //         'price' => "2100",
        //         'sale_price' => rand(100, 1800),
        //         'map_lat' => "37.757522",
        //         'map_lng' => "-122.447984",
        //         'map_zoom' => "12",
        //         'duration' => rand(1,9),
        //         'max_people' => rand(10,20),
        //         'min_people' =>1,
        //         'faqs' => '[{"title":"When and where does the community end?","content":"Your community will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the community start?","content":"Day 1 of this community is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this community, however you can book for an arrival transfer in advance. In this case a community operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This community has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this community. However, if you are over 70 years please contact us as you may be eligible to join the community if you fill out G Adventures self-assessment form."}]',
        //         'status' => "publish",
        //         'create_user' => $create_user,
        //         'created_at' =>  date("Y-m-d H:i:s"),
        //         'include' =>  '[{"title":"Specialized bilingual guide"},{"title":"Private Transport"},{"title":"Entrance fees (Cable and car and Moon Valley)"},{"title":"Box lunch water, banana apple and chocolate"}]',
        //         'exclude' =>  '[{"title":"Additional Services"},{"title":"Insurance"},{"title":"Drink"},{"title":"Tickets"}]',
        //         'itinerary' =>  '[{"image_id":"'.MediaFile::findMediaByName("location-5")->id.'","title":"Day 1","desc":"Los Angeles","content":"There are no activities planned until an evening welcome meeting. Additional Notes: We highly recommend booking pre-community accommodation to fully experience this crazy city."},{"image_id":"'.MediaFile::findMediaByName("location-4")->id.'","title":"Day 2","desc":"Lake Havasu City","content":"Pack up the van in the morning and check out the stars on the most famous sidewalk in Hollywood on an orientation community"},{"image_id":"'.MediaFile::findMediaByName("location-3")->id.'","title":"Day 3","desc":"Las Vegas\/Bakersfield","content":"Travel to one of the country\'s most rugged landscapes \u2014 the legendary Death Valley, California. Soak in the dramatic landscape. In the afternoon, continue on to Bakersfield for the night."},{"image_id":"'.MediaFile::findMediaByName("location-2")->id.'","title":"Day 4","desc":"San Francisco","content":"We highly recommend booking post-accommodation to fully experience this famous city."}]',
        //     ]
        // );
        // $IDs_vendor[] = $create_user =  rand(4,6);
        // $IDs[] = DB::table('bravo_communitys')->insertGetId(
        //     [
        //         'title' => 'Cannes and Antibes Night Community',
        //         'slug' => Str::slug('Cannes and Antibes Night Community', '-'),
        //         'content' => "<p>Start and end in San Francisco! With the in-depth cultural community Northern California Summer 2019, you have a 8 day community package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
        //         'image_id' => MediaFile::findMediaByName("community-15")->id,
        //         'banner_image_id' => MediaFile::findMediaByName("banner-community-15")->id,
        //         'category_id' => rand(1, 4),
        //         'location_id' => 1,
        //         'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
        //         'address' => "UCSF Helen Diller Family",
        //         'is_featured' => "0",
        //         'gallery' => implode(",",$list_gallery),
        //         'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
        //         'price' => "2100",
        //         'sale_price' => rand(100, 1800),
        //         'map_lat' => "36.201066",
        //         'map_lng' => "-88.112292",
        //         'map_zoom' => "12",
        //         'duration' => rand(1,9),
        //         'max_people' => rand(10,20),
        //         'min_people' =>1,
        //         'faqs' => '[{"title":"When and where does the community end?","content":"Your community will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the community start?","content":"Day 1 of this community is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this community, however you can book for an arrival transfer in advance. In this case a community operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This community has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this community. However, if you are over 70 years please contact us as you may be eligible to join the community if you fill out G Adventures self-assessment form."}]',
        //         'status' => "publish",
        //         'create_user' => $create_user,
        //         'created_at' =>  date("Y-m-d H:i:s"),
        //         'include' =>  '[{"title":"Specialized bilingual guide"},{"title":"Private Transport"},{"title":"Entrance fees (Cable and car and Moon Valley)"},{"title":"Box lunch water, banana apple and chocolate"}]',
        //         'exclude' =>  '[{"title":"Additional Services"},{"title":"Insurance"},{"title":"Drink"},{"title":"Tickets"}]',
        //         'itinerary' =>  '[{"image_id":"'.MediaFile::findMediaByName("location-5")->id.'","title":"Day 1","desc":"Los Angeles","content":"There are no activities planned until an evening welcome meeting. Additional Notes: We highly recommend booking pre-community accommodation to fully experience this crazy city."},{"image_id":"'.MediaFile::findMediaByName("location-4")->id.'","title":"Day 2","desc":"Lake Havasu City","content":"Pack up the van in the morning and check out the stars on the most famous sidewalk in Hollywood on an orientation community"},{"image_id":"'.MediaFile::findMediaByName("location-3")->id.'","title":"Day 3","desc":"Las Vegas\/Bakersfield","content":"Travel to one of the country\'s most rugged landscapes \u2014 the legendary Death Valley, California. Soak in the dramatic landscape. In the afternoon, continue on to Bakersfield for the night."},{"image_id":"'.MediaFile::findMediaByName("location-2")->id.'","title":"Day 4","desc":"San Francisco","content":"We highly recommend booking post-accommodation to fully experience this famous city."}]',
        //     ]
        // );
        // $IDs_vendor[] = $create_user =  1;
        // $IDs[] = DB::table('bravo_communitys')->insertGetId(
        //     [
        //         'title' => 'River Cruise Community on the Seine',
        //         'slug' => Str::slug('River Cruise Community on the Seine', '-'),
        //         'content' => "<p>Start and end in San Francisco! With the in-depth cultural community Northern California Summer 2019, you have a 8 day community package taking you through San Francisco, USA and 9 other destinations in USA. Northern California Summer 2019 includes accommodation as well as an expert guide, meals, transport and more.</p><h4>HIGHLIGHTS</h4><ul><li>Visit the Museum of Modern Art in Manhattan</li><li>See amazing works of contemporary art, including Vincent van Gogh's The Starry Night</li><li>Check out Campbell's Soup Cans by Warhol and The Dance (I) by Matisse</li><li>Behold masterpieces by Gauguin, Dali, Picasso, and Pollock</li><li>Enjoy free audio guides available in English, French, German, Italian, Spanish, Portuguese</li></ul>",
        //         'image_id' => MediaFile::findMediaByName("community-16")->id,
        //         'banner_image_id' => MediaFile::findMediaByName("banner-community-16")->id,
        //         'category_id' => rand(1, 4),
        //         'location_id' => 1,
        //         'short_desc' => "From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of 'The City'. Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception",
        //         'address' => "Nevada, US",
        //         'is_featured' => "0",
        //         'gallery' => implode(",",$list_gallery),
        //         'video' => "https://www.youtube.com/watch?v=UfEiKK-iX70",
        //         'price' => "2100",
        //         'sale_price' => rand(100, 1800),
        //         'map_lat' => "36.401066",
        //         'map_lng' => "-88.312292",
        //         'map_zoom' => "12",
        //         'duration' => rand(1,9),
        //         'max_people' => rand(10,20),
        //         'min_people' =>1,
        //         'faqs' => '[{"title":"When and where does the community end?","content":"Your community will conclude in San Francisco on Day 8 of the trip. There are no activities planned for this day so you\'re free to depart at any time. We highly recommend booking post-accommodation to give yourself time to fully experience the wonders of this iconic city!"},{"title":"When and where does the community start?","content":"Day 1 of this community is an arrivals day, which gives you a chance to settle into your hotel and explore Los Angeles. The only planned activity for this day is an evening welcome meeting at 7pm, where you can get to know your guides and fellow travellers. Please be aware that the meeting point is subject to change until your final documents are released."},{"title":"Do you arrange airport transfers?","content":"Airport transfers are not included in the price of this community, however you can book for an arrival transfer in advance. In this case a community operator representative will be at the airport to greet you. To arrange this please contact our customer service team once you have a confirmed booking."},{"title":"What is the age range","content":"This community has an age range of 12-70 years old, this means children under the age of 12 will not be eligible to participate in this community. However, if you are over 70 years please contact us as you may be eligible to join the community if you fill out G Adventures self-assessment form."}]',
        //         'status' => "publish",
        //         'create_user' => $create_user,
        //         'created_at' =>  date("Y-m-d H:i:s"),
        //         'include' =>  '[{"title":"Specialized bilingual guide"},{"title":"Private Transport"},{"title":"Entrance fees (Cable and car and Moon Valley)"},{"title":"Box lunch water, banana apple and chocolate"}]',
        //         'exclude' =>  '[{"title":"Additional Services"},{"title":"Insurance"},{"title":"Drink"},{"title":"Tickets"}]',
        //         'itinerary' =>  '[{"image_id":"'.MediaFile::findMediaByName("location-5")->id.'","title":"Day 1","desc":"Los Angeles","content":"There are no activities planned until an evening welcome meeting. Additional Notes: We highly recommend booking pre-community accommodation to fully experience this crazy city."},{"image_id":"'.MediaFile::findMediaByName("location-4")->id.'","title":"Day 2","desc":"Lake Havasu City","content":"Pack up the van in the morning and check out the stars on the most famous sidewalk in Hollywood on an orientation community"},{"image_id":"'.MediaFile::findMediaByName("location-3")->id.'","title":"Day 3","desc":"Las Vegas\/Bakersfield","content":"Travel to one of the country\'s most rugged landscapes \u2014 the legendary Death Valley, California. Soak in the dramatic landscape. In the afternoon, continue on to Bakersfield for the night."},{"image_id":"'.MediaFile::findMediaByName("location-2")->id.'","title":"Day 4","desc":"San Francisco","content":"We highly recommend booking post-accommodation to fully experience this famous city."}]',
        //     ]
        // );



        // Add meta for community
        foreach ($IDs as $numer_key => $community){
            $vendor_id = $IDs_vendor[$numer_key];
            DB::table('bravo_community_meta')->insertGetId(
                [
                    'community_id' => $community,
                    'enable_person_types' => '1',
                    'person_types' => '[{"name":"Adult","desc":"Age 18+","min":"1","max":"10","price":"1000"},{"name":"Child","desc":"Age 6-17","min":"0","max":"10","price":"300"}]',
                    
                ]
            );
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
                        "object_id"    => $community,
                        "object_model" => "community",
                        "name"         => $value,
                        "val"          => $point,
                        "create_user"  => "1",
                    ];
                }
                $rate = round($total_point / count($list_meta), 1);
                if ($rate > 5) $rate = 5;
                $titles = ["Great Trip","Good Trip","Trip was great","Easy way to discover the city"];
                $review = new Review([
                    "object_id"    => $community,
                    "object_model" => "community",
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

        // Settings Community
        DB::table('core_settings')->insert(
            [
                [
                    'name' => 'community_page_search_title',
                    'val' => 'What type of community would you want',
                    'group' => "community",
                ],
                [
                    'name' => 'community_page_limit_item',
                    'val' => 9,
                    'group' => "community",
                ],
                [
                    'name' => 'community_page_search_banner',
                    'val' => MediaFile::findMediaByName("banner-search")->id,
                    'group' => "community",
                ],
                [
                    'name' => 'community_layout_search',
                    'val' => 'normal',
                    'group' => "community",
                ],
                [
                    'name' => 'community_enable_review',
                    'val' => '1',
                    'group' => "community",
                ],
                [
                    'name' => 'community_review_approved',
                    'val' => '0',
                    'group' => "community",
                ],
                [
                    'name' => 'community_review_stats',
                    'val' => '[{"title":"Service"},{"title":"Organization"},{"title":"Friendliness"},{"title":"Area Expert"},{"title":"Safety"}]',
                    'group' => "community",
                ],
                [
                    'name'=>'community_map_search_fields',
                    'val'=>'[{"field":"location","attr":null,"position":"1"},{"field":"category","attr":null,"position":"2"},{"field":"date","attr":null,"position":"3"},{"field":"price","attr":null,"position":"4"},{"field":"advance","attr":null,"position":"5"}]',
                    'group'=>'community'
                ],
                [
                    'name'=>'community_search_fields',
                    'val'=>'[{"title":"Location","field":"location","size":"6","position":"1"},{"title":"From - To","field":"date","size":"6","position":"2"}]',
                    'group'=>'community'
                ]
            ]
        );

        $a = new \Modules\Core\Models\Attributes([
            'name'=>'Things to do',
            'service'=>'community'
        ]);

        $a->save();

        $term_ids = [];
        foreach (['Cultural','Nature & Adventure','Marine','Independent','Activities','Festival & Events','Special Interest'] as $term){
            $t = new \Modules\Core\Models\Terms([
                'name'=>$term,
                'attr_id'=>$a->id
            ]);

            $t->save();
            $term_ids[] = $t->id;
        }

        foreach ($IDs as $community_id){
            foreach ($term_ids as $k=>$term_id) {
                if( rand(0 , count($term_ids) ) == $k) continue;
                if( rand(0 , count($term_ids) ) == $k) continue;
                if( rand(0 , count($term_ids) ) == $k) continue;
                \Modules\Community\Models\CommunityTerm::firstOrCreate([
                    'term_id' => $term_id,
                    'community_id' => $community_id
                ]);
            }
        }

        // $a = new \Modules\Core\Models\Attributes([
        //     'name'=>'Facilities',
        //     'service'=>'community'
        // ]);
        // $a->save();

        // $term_ids = [];
        // foreach (['Wifi','Gymnasium','Mountain Bike','Satellite Office','Staff Lounge','Golf Cages','Aerobics Room'] as $term){
        //     $t = new \Modules\Core\Models\Terms([
        //         'name'=>$term,
        //         'attr_id'=>$a->id
        //     ]);
        //     $t->save();
        //     $term_ids[] = $t->id;
        // }
        // foreach ($IDs as $community_id){
        //     foreach ($term_ids as $k=>$term_id) {
        //         if( rand(0 , count($term_ids) ) == $k) continue;
        //         if( rand(0 , count($term_ids) ) == $k) continue;
        //         if( rand(0 , count($term_ids) ) == $k) continue;
        //         \Modules\Community\Models\CommunityTerm::firstOrCreate([
        //             'term_id' => $term_id,
        //             'community_id' => $community_id
        //         ]);
        //     }
        // }

        //Update Review Score
        foreach ($IDs as $service_id){
            \Modules\Community\Models\Community::find($service_id)->update_service_rate();
        }
    }
}