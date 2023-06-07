<?php
namespace Modules\Community;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Helpers\SitemapHelper;
use Modules\ModuleServiceProvider;
use Modules\Community\Models\Community;

class ModuleProvider extends ModuleServiceProvider
{
    public function boot(SitemapHelper $sitemapHelper)
    {
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        if(is_installed() and Community::isEnable()){
            $sitemapHelper->add("community",[app()->make(Community::class),'getForSitemap']);
        }
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

    public static function getBookableServices()
    {
        if(!Community::isEnable()) return [];
        return [
            'community' => Community::class,
        ];
    }

    public static function getAdminMenu()
    {
        $res = [];
        if(Community::isEnable()){
            $res['community'] = [
                "position"=>40,
                'url'        => route('community.admin.index'),
                'title'      => __("Community"),
                'icon'       => 'icon ion-md-umbrella',
                'permission' => 'community_view',
                'children'   => [
                    'community_view'=>[
                        'url'        => route('community.admin.index'),
                        'title'      => __('All Communitys'),
                        'permission' => 'community_view',
                    ],
                    'community_create'=>[
                        'url'        => route('community.admin.create'),
                        'title'      => __("Add Community"),
                        'permission' => 'community_create',
                    ],
                    'community_category'=>[
                        'url'        => route('community.admin.category.index'),
                        'title'      => __('Categories'),
                        'permission' => 'community_manage_others',
                    ],
                    'community_attribute'=>[
                        'url'        => route('community.admin.attribute.index'),
                        'title'      => __('Attributes'),
                        'permission' => 'community_manage_attributes',
                    ],
                    'community_availability'=>[
                        'url'        => route('community.admin.availability.index'),
                        'title'      => __('Availability'),
                        'permission' => 'community_create',
                    ],
                    'community_booking'=>[
                        'url'        => route('community.admin.booking.index'),
                        'title'      => __('Booking Calendar'),
                        'permission' => 'community_create',
                    ],
                    'recovery'=>[
                        'url'        => route('community.admin.recovery'),
                        'title'      => __('Recovery'),
                        'permission' => 'community_view',
                    ],
                ]
            ];
        }
        return $res;
    }


    public static function getUserMenu()
    {
        $res = [];
        if(Community::isEnable()){
            $res['community'] = [
                'url'   => route('community.vendor.index'),
                'title'      => __("Manage Community"),
                // 'icon'       => Community::getServiceIconFeatured(),
                'permission' => 'community_view',
                'position'   => 40,
                'children'   => [
                    [
                        'url'   => route('community.vendor.index'),
                        'title' => __("All Communitys"),
                    ],
                    [
                        'url'        => route('community.vendor.create'),
                        'title'      => __("Add Community"),
                        'permission' => 'community_create',
                    ],
                    [
                        'url'        => route('community.vendor.availability.index'),
                        'title'      => __("Availability"),
                        'permission' => 'community_create',
                    ],
                    [
                        'url'   => route('community.vendor.recovery'),
                        'title'      => __("Recovery"),
                        'permission' => 'community_create',
                    ],
                ]
            ];
        }
        return $res;
    }

    public static function getMenuBuilderTypes()
    {
        if(!Community::isEnable()) return [];

        return [
            [
                'class' => \Modules\Community\Models\Community::class,
                'name'  => __("Community"),
                'items' => \Modules\Community\Models\Community::searchForMenu(),
                'position'=>20
            ],
            [
                'class' => \Modules\Community\Models\CommunityCategory::class,
                'name'  => __("Community Category"),
                'items' => \Modules\Community\Models\CommunityCategory::searchForMenu(),
                'position'=>30
            ],
        ];
    }

    public static function getTemplateBlocks(){
        if(!Community::isEnable()) return [];

        return [
            'list_communitys'=>"\\Modules\\Community\\Blocks\\ListCommunitys",
            'form_search_community'=>"\\Modules\\Community\\Blocks\\FormSearchCommunity",
            'box_category_community'=>"\\Modules\\Community\\Blocks\\BoxCategoryCommunity",
        ];
    }
}
