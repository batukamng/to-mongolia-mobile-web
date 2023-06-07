<?php
namespace Database\Seeders;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Media\Models\MediaFile;

class General extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // //Setting header,footer
        // $menu_items_en = $this->generalMenu();
        // DB::table('core_menus')->insert([
        //     'name'        => 'Main Menu',
        //     'items'       => json_encode($menu_items_en),
        //     'create_user' => '1',
        //     'created_at'  => date("Y-m-d H:i:s")
        // ]);
        // $menu_items_ko = $this->generalMenu("/ko");
        // DB::table('core_menu_translations')->insert([
        //     'origin_id'   => '1',
        //     'locale'      => 'ko',
        //     'items'       =>json_encode($menu_items_ko),
        //     'create_user' => '1',
        //     'created_at'  => date("Y-m-d H:i:s")
        // ]);

        // // Setting Home Page
        // $this->call(GeneralHomePageSeeder::class);

        // // Setting Home Tour
        // $this->call(GeneralHomeTourSeeder::class);

        // $this->call(GeneralHomeDayTourSeeder::class);
        // $this->call(GeneralHomePackageSeeder::class);
        // $this->call(GeneralDayTourTereljSeeder::class);
        // $this->call(GeneralDayTourUbSeeder::class);
        // $this->call(GeneralDayTourRidingSeeder::class);
        // $this->call(GeneralDayTourStarSeeder::class);
        // $this->call(GeneralDayTourTastySeeder::class);
        // $this->call(GeneralDayTourNightSeeder::class);
        // $this->call(GeneralDayTourPlaneSeeder::class);

        // $this->call(GeneralPackageGuideSeeder::class);
        // $this->call(GeneralPackageAgencySeeder::class);

        // // Setting Home Community
        // $this->call(GeneralHomeCommunitySeeder::class);

        // // Setting Home Car
        // $this->call(GeneralHomeCarSeeder::class);
        // // $this->call(CarSeeder::class);

        // // Setting Home Tips
        // $this->call(GeneralHomeTipsSeeder::class);

        // // Setting Home Business
        // $this->call(GeneralHomeBusinessSeeder::class);
        
        // // Setting Become Vendor
        // $this->call(GeneralBecomeVendorSeeder::class);

        // // Setting Privacy Policy
        // $this->call(GeneralPrivacyPolicySeeder::class);

        // // Setting Tips > Info
        // $this->call(GeneralTipsInfoSeeder::class);

        // // Setting Tips > Info > Weather
        // $this->call(GeneralTipsInfoWeatherSeeder::class);

        // // Setting Tips > Info > Exchange
        // $this->call(GeneralTipsInfoExchangeSeeder::class);

        // // Setting Tips > Info > USIM/WiFi
        // $this->call(GeneralTipsInfoUSIMSeeder::class);

        // // Setting Tips > Shop
        // $this->call(GeneralTipsShopSeeder::class);

        // // Setting Tips > Shop > Cashmere
        // $this->call(GeneralTipsShopCashmereSeeder::class);

        // // Setting Tips > Shop > Department Store
        // $this->call(GeneralTipsShopDepartmentSeeder::class);

        // // Setting Tips > Shop > Luxury Brand
        // $this->call(GeneralTipsShopLuxurySeeder::class);

        // // Setting Tips > Shop > Accessories
        // $this->call(GeneralTipsShopAccessoriesSeeder::class);

        // // Setting Tips > Insurance
        // $this->call(GeneralTipsInsuranceSeeder::class);

        // // Setting Tips > Beauty
        // $this->call(GeneralTipsBeautySeeder::class);

        // // Setting Tips > Beauty > Hair
        // $this->call(GeneralTipsBeautyHairSeeder::class);

        // // Setting Tips > Beauty > Nail
        // $this->call(GeneralTipsBeautyNailSeeder::class);

        // // Setting Tips > Beauty > Massage
        // $this->call(GeneralTipsBeautyMassageSeeder::class);

        // // Setting Tips > Beauty > Skincare
        // $this->call(GeneralTipsBeautySkincareSeeder::class);

        // // Setting Tips > Blog
        // $this->call(GeneralTipsBlogSeeder::class);

        // // Setting Tour > Hotel & House > Hotel
        // $this->call(GeneralTourHotelSeeder::class);

        // // Setting Tour > Hotel & House > House
        // $this->call(GeneralTourHouseSeeder::class);

        // // Setting Business > Translate
        // $this->call(GeneralBusinessTranslateSeeder::class);
        // $this->call(GeneralBusinessTranslateKoreanSeeder::class);
        // $this->call(GeneralBusinessTranslateEnglishSeeder::class);
        
        // // Setting Business > Vehicle
        // $this->call(GeneralBusinessVehicleSeeder::class);

        // $this->call(GeneralBusinessVehicleAirportSeeder::class);
        // $this->call(GeneralBusinessVehicleRentSeeder::class);
        // $this->call(GeneralBusinessVehicleTaxiSeeder::class);
        
        // // Setting Business > HotelInfo
        // $this->call(GeneralBusinessHotelInfoSeeder::class);
        
        // // Setting Business > TourInfo
        // $this->call(GeneralBusinessTourInfoSeeder::class);

        // $this->call(GeneralBusinessTourInfoBusinessGolfSeeder::class);
        // $this->call(GeneralBusinessTourInfoBusinessTereljSeeder::class);
        // $this->call(GeneralBusinessTourInfoBusinessUbTourSeeder::class);
        
        // // Setting Business > Food
        // $this->call(GeneralBusinessFoodSeeder::class);
        
        // // Setting Business > Finance
        // $this->call(GeneralBusinessFinanceSeeder::class);

        // $this->call(GeneralBusinessExchangeSeeder::class);
        // $this->call(GeneralBusinessInsuranceSeeder::class);
        // $this->call(GeneralBusinessCareServiceSeeder::class);

        // $this->call(EventFoodDrinkSeeder::class);
        // $this->call(EventPhotoSeeder::class);
        // $this->call(EventPlaneSeeder::class);
        // $this->call(EventShowSeeder::class);
        // $this->call(EventTheMuseumSeeder::class);

        // $this->call(RestaurantSteakSeeder::class);
        // $this->call(RestaurantMongolianSeeder::class);
        // $this->call(RestaurantKoreanSeeder::class);
        // $this->call(RestaurantJapaneseSeeder::class);
        // $this->call(RestaurantChineseSeeder::class);
        // $this->call(RestaurantVeganSeeder::class);
        // $this->call(RestaurantSuggestionSeeder::class);

        // $this->call(RestaurantBusinessSteakSeeder::class);
        // $this->call(RestaurantBusinessMongolianSeeder::class);
        // $this->call(RestaurantBusinessKoreanSeeder::class);
        // $this->call(RestaurantBusinessJapaneseSeeder::class);
        // $this->call(RestaurantBusinessChineseSeeder::class);
        // $this->call(RestaurantBusinessVeganSeeder::class);
        // $this->call(RestaurantBusinessSuggestionSeeder::class);

        
    }

    // public function generalMenu($locale = ''){
    //     return  array(
    //         array(
    //             'name'       => 'Hotel',
    //             'url'        => $locale.'/page/hotel',
    //             'item_model' => 'custom',
    //             'model_name' => 'Custom',
    //         ),
    //         array(
    //             'name'       => 'Tours',
    //             'url'        => $locale.'/page/tour',
    //             'item_model' => 'custom',
    //             'model_name' => 'Custom',
    //             'children'   => array(),
    //         ),
    //         array(
    //             'name'       => 'Communitys',
    //             'url'        => $locale.'/community',
    //             'item_model' => 'custom',
    //             'model_name' => 'Custom',
    //             'children'   => array(),
    //         ),
    //         array(
    //             'name'       => 'Space',
    //             'url'        => $locale.'/page/space',
    //             'item_model' => 'custom',
    //             'model_name' => 'Custom',
    //             'children'   => array(),
    //         ),
    //         array(
    //             'name'       => 'Car',
    //             'url'        => $locale.'/car',
    //             'item_model' => 'custom',
    //             'model_name' => 'Custom',
    //             'children'   => array(),
    //         ),
    //         array(
    //             'name'       => 'Restaurant',
    //             'url'        => $locale.'/page/restaurant',
    //             'item_model' => 'custom',
    //             'model_name' => 'Custom',
    //             'children'   => array(),
    //         ),
    //         array(
    //             'name'       => 'Event',
    //             'url'        => $locale.'page/event',
    //             'item_model' => 'custom',
    //             'model_name' => 'Custom',
    //             'children'   => array(),
    //         ),
    //         array(
    //             'name'       => 'Flight',
    //             'url'        => $locale.'/flight',
    //             'item_model' => 'custom',
    //             'model_name' => 'Custom',
    //         ),
    //     );
    // }
}
