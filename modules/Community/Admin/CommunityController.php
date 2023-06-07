<?php
namespace Modules\Community\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\AdminController;
use Modules\Core\Events\CreatedServicesEvent;
use Modules\Core\Events\UpdatedServiceEvent;
use Modules\Core\Models\Attributes;
use Modules\Location\Models\LocationCategory;
use Modules\Community\Hook;
use Modules\Community\Models\CommunityTerm;
use Modules\Community\Models\Community;
use Modules\Community\Models\CommunityCategory;
use Modules\Community\Models\CommunityTranslation;
use Modules\Location\Models\Location;

class CommunityController extends AdminController
{
    protected $communityClass;
    protected $communityTranslationClass;
    protected $communityCategoryClass;
    protected $communityTermClass;
    protected $attributesClass;
    protected $locationClass;
    /**
     * @var string
     */
    private $locationCategoryClass;

    public function __construct()
    {
        parent::__construct();
        $this->setActiveMenu(route('community.admin.index'));
        $this->communityClass = Community::class;
        $this->communityTranslationClass = CommunityTranslation::class;
        $this->communityCategoryClass = CommunityCategory::class;
        $this->communityTermClass = CommunityTerm::class;
        $this->attributesClass = Attributes::class;
        $this->locationClass = Location::class;
        $this->locationCategoryClass = LocationCategory::class;
    }

    public function index(Request $request)
    {
        $this->checkPermission('community_view');
        $query = $this->communityClass::query();
        $query->orderBy('id', 'desc');
        if (!empty($community_name = $request->input('s'))) {
            $query->where('title', 'LIKE', '%' . $community_name . '%');
            $query->orderBy('title', 'asc');
        }
        if (!empty($cate = $request->input('cate_id'))) {
            $query->where('category_id', $cate);
        }
        if (!empty($is_featured = $request->input('is_featured'))) {
            $query->where('is_featured', 1);
        }
        if (!empty($location_id = $request->query('location_id'))) {
            $query->where('location_id', $location_id);
        }
        if ($this->hasPermission('community_manage_others')) {
            if (!empty($author = $request->input('vendor_id'))) {
                $query->where('create_user', $author);
            }
        } else {
            $query->where('create_user', Auth::id());
        }
        $data = [
            'rows'               => $query->with([
                'getAuthor',
                'category_community'
            ])->paginate(20),
            'community_categories'    => $this->communityCategoryClass::where('status', 'publish')->get()->toTree(),
            'community_manage_others' => $this->hasPermission('community_manage_others'),
            'page_title'         => __("Community Management"),
            'breadcrumbs'        => [
                [
                    'name' => __('Communitys'),
                    'url'  => route('community.admin.index')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Community::admin.index', $data);
    }

    public function recovery(Request $request)
    {
        $this->checkPermission('community_view');
        $query = $this->communityClass::onlyTrashed();
        $query->orderBy('id', 'desc');
        if (!empty($community_name = $request->input('s'))) {
            $query->where('title', 'LIKE', '%' . $community_name . '%');
            $query->orderBy('title', 'asc');
        }
        if (!empty($cate = $request->input('cate_id'))) {
            $query->where('category_id', $cate);
        }
        if ($this->hasPermission('community_manage_others')) {
            if (!empty($author = $request->input('vendor_id'))) {
                $query->where('create_user', $author);
            }
        } else {
            $query->where('create_user', Auth::id());
        }
        $data = [
            'rows'               => $query->with([
                'getAuthor',
                'category_community'
            ])->paginate(20),
            'community_categories'    => $this->communityCategoryClass::where('status', 'publish')->get()->toTree(),
            'community_manage_others' => $this->hasPermission('community_manage_others'),
            'page_title'         => __("Recovery Community Management"),
            'recovery'           => 1,
            'breadcrumbs'        => [
                [
                    'name' => __('Communitys'),
                    'url'  => route('community.admin.index')
                ],
                [
                    'name'  => __('Recovery'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Community::admin.index', $data);
    }

    public function create(Request $request)
    {
        $this->checkPermission('community_create');
        $row = new Community();
        $row->fill([
            'status' => 'publish'
        ]);
        $data = [
            'row'               => $row,
            'attributes'        => $this->attributesClass::where('service', 'community')->get(),
            'community_category'     => $this->communityCategoryClass::where('status', 'publish')->get()->toTree(),
            'community_location'     => $this->locationClass::where('status', 'publish')->get()->toTree(),
            'location_category' => $this->locationCategoryClass::where("status", "publish")->get(),
            'translation'       => new $this->communityTranslationClass(),
            'breadcrumbs'       => [
                [
                    'name' => __('Communitys'),
                    'url'  => route('community.admin.index')
                ],
                [
                    'name'  => __('Add Community'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Community::admin.detail', $data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('community_update');
        $row = $this->communityClass::find($id);
        if (empty($row)) {
            return redirect(route('community.admin.index'));
        }
        $translation = $row->translateOrOrigin($request->query('lang'));
        if (!$this->hasPermission('community_manage_others')) {
            if ($row->create_user != Auth::id()) {
                return redirect(route('community.admin.index'));
            }
        }
        $data = [
            'row'               => $row,
            'translation'       => $translation,
            "selected_terms"    => $row->community_term->pluck('term_id'),
            'attributes'        => $this->attributesClass::where('service', 'community')->get(),
            'community_category'     => $this->communityCategoryClass::where('status', 'publish')->get()->toTree(),
            'community_location'     => $this->locationClass::where('status', 'publish')->get()->toTree(),
            'location_category' => $this->locationCategoryClass::where("status", "publish")->get(),
            'enable_multi_lang' => true,
            'breadcrumbs'       => [
                [
                    'name' => __('Communitys'),
                    'url'  => route('community.admin.index')
                ],
                [
                    'name'  => __('Edit Community'),
                    'class' => 'active'
                ],
            ],
            'page_title'=>__('Edit Community')
        ];
        return view('Community::admin.detail', $data);
    }

    public function store(Request $request, $id)
    {

        if ($id > 0) {
            $this->checkPermission('community_update');
            $row = $this->communityClass::find($id);
            if (empty($row)) {
                return redirect(route('community.admin.index'));
            }
            if ($row->create_user != Auth::id() and !$this->hasPermission('community_manage_others')) {
                return redirect(route('community.admin.index'));
            }
        } else {
            $this->checkPermission('community_create');
            $row = new $this->communityClass();
            $row->status = "publish";
        }
        if(!empty($request->input('enable_fixed_date'))){
            $rules = [
                'start_date'        =>'required|date',
                'end_date'         =>'required|date|after_or_equal:start_date',
                'last_booking_date' =>'required|date|before:start_date'
            ];
            $request->validate($rules);
        }

        $row->fill($request->input());
        if ($request->input('slug')) {
            $row->slug = $request->input('slug');
        }
        $row->ical_import_url = $request->ical_import_url;
        $row->create_user = $request->input('create_user');
        $row->default_state = $request->input('default_state', 1);
        $row->enable_service_fee = $request->input('enable_service_fee');
        $row->service_fee = $request->input('service_fee');
        $res = $row->saveOriginOrTranslation($request->input('lang'), true);

        if ($res) {
            if (!$request->input('lang') or is_default_lang($request->input('lang'))) {
                $this->saveTerms($row, $request);
                $row->saveMeta($request);
            }

            do_action(Hook::AFTER_SAVING,$row,$request);

            if ($id > 0) {
                event(new UpdatedServiceEvent($row));
                return back()->with('success', __('Community updated'));
            } else {
                event(new CreatedServicesEvent($row));
                return redirect(route('community.admin.edit', $row->id))->with('success', __('Community created'));
            }
        }
    }

    public function saveTerms($row, $request)
    {
        if (empty($request->input('terms'))) {
            $this->communityTermClass::where('community_id', $row->id)->delete();
        } else {
            $term_ids = $request->input('terms');
            foreach ($term_ids as $term_id) {
                $this->communityTermClass::firstOrCreate([
                    'term_id' => $term_id,
                    'community_id' => $row->id
                ]);
            }
            $this->communityTermClass::where('community_id', $row->id)->whereNotIn('term_id', $term_ids)->delete();
        }
    }

    public function bulkEdit(Request $request)
    {

        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('No items selected!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Please select an action!'));
        }
        switch ($action) {
            case "delete":
                foreach ($ids as $id) {
                    $query = $this->communityClass::where("id", $id);
                    if (!$this->hasPermission('community_manage_others')) {
                        $query->where("create_user", Auth::id());
                        $this->checkPermission('community_delete');
                    }
                    $row = $query->first();
                    if (!empty($row)) {
                        $row->delete();
                        event(new UpdatedServiceEvent($row));
                    }
                }
                return redirect()->back()->with('success', __('Deleted success!'));
                break;
            case "permanently_delete":
                foreach ($ids as $id) {
                    $query = $this->communityClass::where("id", $id);
                    if (!$this->hasPermission('community_manage_others')) {
                        $query->where("create_user", Auth::id());
                        $this->checkPermission('community_delete');
                    }
                    $row = $query->withTrashed()->first();
                    if ($row) {
                        $row->forceDelete();
                    }
                }
                return redirect()->back()->with('success', __('Permanently delete success!'));
                break;
            case "recovery":
                foreach ($ids as $id) {
                    $query = $this->communityClass::withTrashed()->where("id", $id);
                    if (!$this->hasPermission('community_manage_others')) {
                        $query->where("create_user", Auth::id());
                        $this->checkPermission('community_delete');
                    }
                    $row = $query->first();
                    if (!empty($row)) {
                        $row->restore();
                        event(new UpdatedServiceEvent($row));
                    }
                }
                return redirect()->back()->with('success', __('Recovery success!'));
                break;
            case "clone":
                $this->checkPermission('community_create');
                foreach ($ids as $id) {
                    (new $this->communityClass())->saveCloneByID($id);
                }
                return redirect()->back()->with('success', __('Clone success!'));
                break;
            default:
                // Change status
                foreach ($ids as $id) {
                    $query = $this->communityClass::where("id", $id);
                    if (!$this->hasPermission('community_manage_others')) {
                        $query->where("create_user", Auth::id());
                        $this->checkPermission('community_update');
                    }
                    $row = $query->first();
                    $row->status = $action;
                    $row->save();
                    event(new UpdatedServiceEvent($row));
                }
                return redirect()->back()->with('success', __('Update success!'));
                break;
        }
    }

    public function getForSelect2(Request $request)
    {
        $pre_selected = $request->query('pre_selected');
        $selected = $request->query('selected');
        if ($pre_selected && $selected) {
            if (is_array($selected)) {
                $items = $this->communityClass::select('id', 'title as text')->whereIn('id', $selected)->take(50)->get();
                return $this->sendSuccess([
                    'items' => $items
                ]);
            } else {
                $item = $this->communityClass::find($selected);
            }
            if (empty($item)) {
                return $this->sendSuccess([
                    'text' => ''
                ]);
            } else {
                return $this->sendSuccess([
                    'text' => $item->name
                ]);
            }
        }
        $q = $request->query('q');
        $query = $this->communityClass::select('id', 'title as text')->where("status", "publish");
        if ($q) {
            $query->where('title', 'like', '%' . $q . '%');
        }
        $res = $query->orderBy('id', 'desc')->limit(20)->get();
        return $this->sendSuccess([
            'results' => $res
        ]);
    }
}
