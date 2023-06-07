<?php
namespace Modules\Community\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Community\Models\CommunityCategory;
use Modules\Community\Models\CommunityCategoryTranslation;

class CategoryController extends AdminController
{
    protected $communityCategoryClass;
    public function __construct()
    {
        parent::__construct();
        $this->setActiveMenu(route('community.admin.index'));
        $this->communityCategoryClass = CommunityCategory::class;
    }

    public function index(Request $request)
    {
        $this->checkPermission('community_manage_others');
        $listCategory = $this->communityCategoryClass::query();
        if (!empty($search = $request->query('s'))) {
            $listCategory->where('name', 'LIKE', '%' . $search . '%');
        }
        $listCategory->orderBy('created_at', 'desc');
        $data = [
            'rows'        => $listCategory->get()->toTree(),
            'row'         => new $this->communityCategoryClass(),
            'translation'    => new CommunityCategoryTranslation(),
            'breadcrumbs' => [
                [
                    'name' => __('Community'),
                    'url'  => route('community.admin.index')
                ],
                [
                    'name'  => __('Category'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Community::admin.category.index', $data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('community_manage_others');
        $row = $this->communityCategoryClass::find($id);
        if (empty($row)) {
            return redirect(route('community.admin.category.index'));
        }
        $translation = $row->translateOrOrigin($request->query('lang'));
        $data = [
            'translation'    => $translation,
            'enable_multi_lang'=>true,
            'row'         => $row,
            'parents'     => $this->communityCategoryClass::get()->toTree(),
            'breadcrumbs' => [
                [
                    'name' => __('Community'),
                    'url'  => route('community.admin.index')
                ],
                [
                    'name'  => __('Category'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Community::admin.category.detail', $data);
    }

    public function store(Request $request , $id)
    {
        $this->checkPermission('community_manage_others');
        $this->validate($request, [
            'name' => 'required'
        ]);
        if($id>0){
            $row = $this->communityCategoryClass::find($id);
            if (empty($row)) {
                return redirect(route('community.admin.category.index'));
            }
        }else{
            $row = new $this->communityCategoryClass();
            $row->status = "publish";
        }

        $row->fill($request->input());
        $res = $row->saveOriginOrTranslation($request->input('lang'),true);

        if ($res) {
            return back()->with('success',  __('Category saved') );
        }
    }

    public function bulkEdit(Request $request)
    {
        $this->checkPermission('community_manage_others');
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('Select at least 1 item!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Select an Action!'));
        }
        if ($action == "delete") {
            foreach ($ids as $id) {
                $query = $this->communityCategoryClass::where("id", $id)->first();
                if(!empty($query)){
                    //Sync child category
                    $list_childs = $this->communityCategoryClass::where("parent_id", $id)->get();
                    if(!empty($list_childs)){
                        foreach ($list_childs as $child){
                            $child->parent_id = null;
                            $child->save();
                        }
                    }
                    //Del parent category
                    $query->delete();
                }
            }
        } else {
            foreach ($ids as $id) {
                $query = $this->communityCategoryClass::where("id", $id);
                $query->update(['status' => $action]);
            }
        }
        return redirect()->back()->with('success', __('Updated success!'));
    }

    public function getForSelect2(Request $request)
    {
        $pre_selected = $request->query('pre_selected');
        $selected = $request->query('selected');

        if($pre_selected && $selected){
            $item = $this->communityCategoryClass::find($selected);
            if(empty($item)){
                return response()->json([
                    'text'=>''
                ]);
            }else{
                return response()->json([
                    'text'=>$item->name
                ]);
            }
        }
        $q = $request->query('q');
        $query = $this->communityCategoryClass::select('id', 'name as text')->where("status","publish");
        if ($q) {
            $query->where('name', 'like', '%' . $q . '%');
        }
        $res = $query->orderBy('id', 'desc')->limit(20)->get();
        return response()->json([
            'results' => $res
        ]);
    }
}
