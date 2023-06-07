<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/2/2019
 * Time: 10:26 AM
 */
namespace  Modules\Community;

use Modules\Core\Abstracts\BaseSettingsClass;

class SettingClass extends BaseSettingsClass
{
    public static function getSettingPages()
    {
        return [
            [
                'id'   => 'community',
                'title' => __("Community Settings"),
                'position'=>20,
                'view'=>"Community::admin.settings.community",
                "keys"=>[
                    'community_disable',
                    'community_page_search_title',
                    'community_page_search_banner',
                    'community_layout_search',
                    'community_location_search_style',
                    'community_page_limit_item',

                    'community_enable_review',
                    'community_review_approved',
                    'community_enable_review_after_booking',
                    'community_review_number_per_page',
                    'community_review_stats',
                    'community_page_list_seo_title',
                    'community_page_list_seo_desc',
                    'community_page_list_seo_image',
                    'community_page_list_seo_share',
                    'community_booking_buyer_fees',
                    'community_vendor_create_service_must_approved_by_admin',
                    'community_allow_vendor_can_change_their_booking_status',
                    'community_allow_vendor_can_change_paid_amount',
                    'community_allow_vendor_can_add_service_fee',
                    'community_search_fields',
                    'community_map_search_fields',

                    'community_allow_review_after_making_completed_booking',
                    'community_deposit_enable',
                    'community_deposit_type',
                    'community_deposit_amount',
                    'community_deposit_fomular',

                    'community_layout_map_option',
                    'community_icon_marker_map',

                    'community_map_lat_default',
                    'community_map_lng_default',
                    'community_map_zoom_default',

                    'community_location_radius_value',
                    'community_location_radius_type',
                ],
                'html_keys'=>[

                ]
            ]
        ];
    }
}
