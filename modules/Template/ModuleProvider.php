<?php
namespace Modules\Template;

use Modules\ModuleServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }

    public static function getTemplateBlocks(){
        return [
            // 'row'=>"\\Modules\\Template\\Blocks\\Row",
            // 'column'=>"\\Modules\\Template\\Blocks\\Column",
            'text'=>"\\Modules\\Template\\Blocks\\Text",
            'call_to_action'=>"\\Modules\\Tour\\Blocks\\CallToAction",
            'video_player'=>"\\Modules\\Template\\Blocks\\VideoPlayer",
            'faqs'=>"\\Modules\\Template\\Blocks\\FaqList",
            'list_featured_item'=>"\\Modules\\Tour\\Blocks\\ListFeaturedItem",
            'testimonial'=>"\\Modules\\Tour\\Blocks\\Testimonial",
            'form_search_all_service'=>"\\Modules\\Template\\Blocks\\FormSearchAllService",
            'offer_block'=>"\\Modules\\Template\\Blocks\\OfferBlock",
            'how_it_works'=>"\\Modules\\Template\\Blocks\\HowItWork",
            'client_feedback'=>"\\Modules\\Template\\Blocks\\ClientFeedBack",
            'top_features'=>"\\Modules\\Template\\Blocks\\TopFeatures",
            'slide_banners'=>"\\Modules\\Template\\Blocks\\SlideBanners",
            'sub_features'=>"\\Modules\\Template\\Blocks\\SubFeatures",
            'page_content'=>"\\Modules\\Template\\Blocks\\PageContent",
            'info_image'=>"\\Modules\\Template\\Blocks\\InfoImage",
            'tip_locations'=>"\\Modules\\Template\\Blocks\\TipLocations",
        ];
    }
}
