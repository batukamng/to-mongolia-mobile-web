<?php
namespace Modules\News\Controllers;

use Illuminate\Http\Request;
use Modules\FrontendController;
use Modules\Language\Models\Language;
use Modules\News\Models\News;
use Modules\News\Models\NewsCategory;
use Modules\News\Models\NewsTranslation;
use Modules\News\Models\Tag;
use Modules\Tour\Blocks\ListTours;

class NewsController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $model_News = News::query()->select("core_news.*");
        $model_News->where("core_news.status", "publish")->orderBy('core_news.id', 'desc');
        if (!empty($search = $request->input("s"))) {
            $model_News->where(function($query) use ($search) {
                $query->where('core_news.title', 'LIKE', '%' . $search . '%');
                $query->orWhere('core_news.content', 'LIKE', '%' . $search . '%');
            });

            if( setting_item('site_enable_multi_lang') && setting_item('site_locale') != app_get_locale() ){
                $model_News->leftJoin('core_news_translations', function ($join) use ($search) {
                    $join->on('core_news.id', '=', 'core_news_translations.origin_id');
                });
                $model_News->orWhere(function($query) use ($search) {
                    $query->where('core_news_translations.title', 'LIKE', '%' . $search . '%');
                    $query->orWhere('core_news_translations.content', 'LIKE', '%' . $search . '%');
                });
            }

            $title_page = __('Search results : ":s"', ["s" => $search]);
        }
        $data = [
            'rows'              => $model_News->with("getAuthor")->with('translations')->with("getCategory")->paginate(5),
            'model_category'    => NewsCategory::query()->where("status", "publish"),
            'model_tag'         => Tag::query(),
            'model_news'        => News::query()->where("status", "publish"),
            'custom_title_page' => $title_page ?? "",
            'breadcrumbs'       => [
                [
                    'name'  => __('News'),
                    'url'  => route('news.index'),
                    'class' => 'active'
                ],
            ],
            "seo_meta" => News::getSeoMetaForPageList(),
            "languages"=>Language::getActive(false),
            "locale"=> app()->getLocale(),
            'header_transparent'=>true,
        ];
        return view('News::frontend.index', $data);
    }

    public function detail(Request $request, $slug)
    {
        $row = News::where('slug', $slug)->where('status','publish')->first();
        if (empty($row)) {
            return redirect('/');
        }
        $translation = $row->translateOrOrigin(app()->getLocale());

        $blockModel = new ListTours();
        $listTourModel = [];
        if (method_exists($blockModel, 'content')) {
            $listTourModel = call_user_func([
                $blockModel,
                'query'
            ], [
                "title" => "Go to Venice",
                "number" => 5,
                "style" => "carousel_simple",
                "category_id" => "",
                "location_id" => "",
                "order" => "id",
                "order_by" => "asc",
                "desc" => "It is a long established fact that a reader will be distracted by the readable content of a page ...",
                "is_featured" => "",
            ]);
        }

        $data = [
            'row'               => $row,
            'translation'       => $translation,
            'model_category'    => NewsCategory::where("status", "publish"),
            'model_tag'         => Tag::query(),
            'model_news'        => News::where("status", "publish"),
            'custom_title_page' => $title_page ?? "",
            'breadcrumbs'       => [
                [
                    'name' => __('News'),
                    'url'  => route('news.index')
                ],
                [
                    'name'  => $translation->title,
                    'class' => 'active'
                ],
            ],
            'seo_meta'  => $row->getSeoMetaWithTranslation(app()->getLocale(),$translation),
            'listTour' => [
                'rows'       => $listTourModel,
                'style_list' => "carousel_news",
                'title'      => "이런 여행 어때요 ?",
                'desc'      => "",
            ],
            'subFeatures' => [
                ["_active" => true, "title" => "몽골 정보", "link" => "/page/tips-info-weather", "icon" => $this->getIcon("montips")],
                ["_active" => true, "title" => "쇼핑", "link" => "/page/tips-shop", "icon" => $this->getIcon("shop")],
                ["_active" => true, "title" => "뷰티", "link" => "/page/tips-beauty", "icon" => $this->getIcon("beauty")],
                ["_active" => true, "title" => "Blog", "link" => "/page/tips-blog", "icon" => $this->getIcon("blog"), "class" => "active"],
            ],
        ];
        $this->setActiveMenu($row);
        // dd($data);
        return view('News::frontend.detail', $data);
    }

    private function getIcon($type): string
    {
        return svg_icon_set($type);
    }
}
