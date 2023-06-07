<?php
namespace Database\Seeders;
use Database\Seeders\FlightSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Modules\Theme\ThemeManager;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $active_theme = ThemeManager::current();
        // $theme_seeder = '\\Themes\\'.ucfirst($active_theme)."\\Database\\Seeders\\DatabaseSeeder";
        // if(class_exists($theme_seeder)){
        //     $this->call($theme_seeder);
        //     return;
        // }

        Artisan::call('cache:clear');
        // $this->call(RolesAndPermissionsSeeder::class);
        // $this->call(Language::class);
        // $this->call(UsersTableSeeder::class);
        // $this->call(MediaFileSeeder::class);
        // $this->call(LocationSeeder::class);
        // $this->call(General::class);
        // $this->call(SettingSeeder::class);
        // $this->call(News::class);
        // $this->call(Tour::class);
        // $this->call(Community::class);
        // $this->call(SpaceSeeder::class);
        // $this->call(HotelSeeder::class);
        // $this->call(CarSeeder::class);
        // // $this->call(PickupSeeder::class);
        // $this->call(EventSeeder::class);
        // $this->call(SocialSeeder::class);
        // $this->call(FlightSeeder::class);
        // // $this->call(BoatSeeder::class);
        // $this->call(RestaurantSeeder::class);
        // $this->call(ContactUsSeeder::class);

        // CSV Data Seeder
        // $this->call(CsvDataSeeder::class);
    }
}