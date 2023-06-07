<?php
namespace Modules\Community\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Community\Models\Community;
use Modules\Community\Models\CommunityCategory;

class BookingController extends AdminController
{
    protected $communityClass;
    public function __construct()
    {
        $this->setActiveMenu(route('community.admin.index'));
        parent::__construct();
        $this->communityClass = Community::class;
    }

    public function index(Request $request){

        $this->checkPermission('community_create');

        $q = $this->communityClass::query();

        if($request->query('s')){
            $q->where('title','like','%'.$request->query('s').'%');
        }

        if ($cat_id = $request->query('cat_id')) {
            $cat = CommunityCategory::find($cat_id);
            if(!empty($cat)) {
                $q->join('bravo_community_category', function ($join) use ($cat) {
                    $join->on('bravo_community_category.id', '=', 'bravo_communitys.category_id')
                        ->where('bravo_community_category._lft','>=',$cat->_lft)
                        ->where('bravo_community_category._rgt','>=',$cat->_lft);
                });
            }
        }

        if(!$this->hasPermission('community_manage_others')){
            $q->where('create_user',$this->currentUser()->id);
        }

        $q->orderBy('bravo_communitys.id','desc');

        $rows = $q->paginate(10);

        $current_month = time();

        if($request->query('month')){
            $date = date_create_from_format('m-Y',$request->query('month'));
            if(!$date){
                $current_month = time();
            }else{
                $current_month = $date->getTimestamp();
            }
        }

        $prev_url = route('community.admin.booking.index',array_merge($request->query(),[
           'month'=> date('m-Y',$current_month - MONTH_IN_SECONDS)
        ]));
        $next_url = route('community.admin.booking.index',array_merge($request->query(),[
           'month'=> date('m-Y',$current_month + MONTH_IN_SECONDS)
        ]));

        $community_categories = CommunityCategory::where('status', 'publish')->get()->toTree();
        $breadcrumbs = [
            [
                'name' => __('Communitys'),
                'url'  => route('community.admin.index')
            ],
            [
                'name'  => __('Booking'),
                'class' => 'active'
            ],
        ];
        $page_title = __('Community Booking History');
        return view('Community::admin.booking.index',compact('rows','community_categories','breadcrumbs','current_month','page_title','request','prev_url','next_url'));
    }
    public function test(){
        $d = new \DateTime('2019-07-04 00:00:00');

        $d->modify('+ 4 hours');
        echo $d->format('Y-m-d H:i:s');
    }
}
