<?php
namespace Modules\Boat;
use Modules\Boat\Models\Boat;
use Modules\ModuleServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(){

        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }

    public static function getAdminMenu()
    {
        if(!Boat::isEnable()) return [];
        return [
            'boat'=>[
                "position"=>45,
                'url'        => route('boat.admin.index'),
                'title'      => __('Restaurant'),
                'icon'       => 'ion-md-restaurant',
                'permission' => 'boat_view',
                'children'   => [
                    'add'=>[
                        'url'        => route('boat.admin.index'),
                        'title'      => __('All Restaurants'),
                        'permission' => 'boat_view',
                    ],
                    'create'=>[
                        'url'        => route('boat.admin.create'),
                        'title'      => __('Add new Restaurant'),
                        'permission' => 'boat_create',
                    ],
                    'attribute'=>[
                        'url'        => route('boat.admin.attribute.index'),
                        'title'      => __('Attributes'),
                        'permission' => 'boat_manage_attributes',
                    ],
                    'availability'=>[
                        'url'        => route('boat.admin.availability.index'),
                        'title'      => __('Availability'),
                        'permission' => 'boat_create',
                    ],
                    'recovery'=>[
                        'url'        => route('boat.admin.recovery'),
                        'title'      => __('Recovery'),
                        'permission' => 'boat_view',
                    ],
                ]
            ]
        ];
    }

    public static function getBookableServices()
    {
        if(!Boat::isEnable()) return [];
        return [
            'boat'=>Boat::class
        ];
    }

    public static function getMenuBuilderTypes()
    {
        if(!Boat::isEnable()) return [];
        return [
            'boat'=>[
                'class' => Boat::class,
                'name'  => __("Restaurant"),
                'items' => Boat::searchForMenu(),
                'position'=>51
            ]
        ];
    }

    public static function getUserMenu()
    {
        $res = [];
        if(Boat::isEnable()){
            $res['boat'] = [
                'url'   => route('boat.vendor.index'),
                'title'      => __("Manage Restaurant"),
                'icon'       => Boat::getServiceIconFeatured(),
                'position'   => 70,
                'permission' => 'boat_view',
                'children' => [
                    [
                        'url'   => route('boat.vendor.index'),
                        'title'  => __("All Restaurants"),
                    ],
                    [
                        'url'   => route('boat.vendor.create'),
                        'title'      => __("Add Restaurants"),
                        'permission' => 'boat_create',
                    ],
                    [
                        'url'        => route('boat.vendor.availability.index'),
                        'title'      => __("Availability"),
                        'permission' => 'boat_create',
                    ],
                    [
                        'url'   => route('boat.vendor.recovery'),
                        'title'      => __("Recovery"),
                        'permission' => 'boat_create',
                    ],
                ]
            ];
        }
        return $res;
    }

    public static function getTemplateBlocks(){
        if(!Boat::isEnable()) return [];
        return [
            'form_search_boat'=>"\\Modules\\Boat\\Blocks\\FormSearchBoat",
            'list_boat'=>"\\Modules\\Boat\\Blocks\\ListBoat",
        ];
    }
}
