<?php
namespace Modules\Community\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Community\Models\Community;
use Modules\Community\Models\CommunityCategory;
use Modules\Location\Models\Location;

class ListCommunitys extends BaseBlock
{
    public function getOptions(){
        return [
            'settings' => [
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'id'        => 'desc',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Desc')
                ],
                [
                    'id'        => 'number',
                    'type'      => 'input',
                    'inputType' => 'number',
                    'label'     => __('Number Item')
                ],
                [
                    'id'            => 'style',
                    'type'          => 'radios',
                    'label'         => __('Style'),
                    'values'        => [
                        [
                            'value'   => 'normal',
                            'name' => __("Normal")
                        ],
                        [
                            'value'   => 'carousel',
                            'name' => __("Slider Carousel")
                        ],
                        [
                            'value'   => 'box_shadow',
                            'name' => __("Box Shadow")
                        ],
                        [
                            'value'   => 'carousel_simple',
                            'name' => __("Slider Carousel Simple")
                        ],
                    ]
                ],
                [
                    'id'      => 'category_id',
                    'type'    => 'select2',
                    'label'   => __('Filter by Category'),
                    'select2' => [
                        'ajax'  => [
                            'url'      => route('community.admin.category.category.getForSelect2'),
                            'dataType' => 'json'
                        ],
                        'width' => '100%',
                        'allowClear' => 'true',
                        'placeholder' => __('-- Select --')
                    ],
                    'pre_selected'=>route('community.admin.category.category.getForSelect2',['pre_selected'=>1])
                ],
                [
                    'id'      => 'location_id',
                    'type'    => 'select2',
                    'label'   => __('Filter by Location'),
                    'select2' => [
                        'ajax'  => [
                            'url'      => route('location.admin.getForSelect2'),
                            'dataType' => 'json'
                        ],
                        'width' => '100%',
                        'allowClear' => 'true',
                        'placeholder' => __('-- Select --')
                    ],
                    'pre_selected'=>route('location.admin.getForSelect2',['pre_selected'=>1])
                ],
                [
                    'id'            => 'order',
                    'type'          => 'radios',
                    'label'         => __('Order'),
                    'values'        => [
                        [
                            'value'   => 'id',
                            'name' => __("Date Create")
                        ],
                        [
                            'value'   => 'title',
                            'name' => __("Title")
                        ],
                    ]
                ],
                [
                    'id'            => 'order_by',
                    'type'          => 'radios',
                    'label'         => __('Order By'),
                    'values'        => [
                        [
                            'value'   => 'asc',
                            'name' => __("ASC")
                        ],
                        [
                            'value'   => 'desc',
                            'name' => __("DESC")
                        ],
                    ]
                ],
                [
                    'type'=> "checkbox",
                    'label'=>__("Only featured items?"),
                    'id'=> "is_featured",
                    'default'=>true
                ],
                [
                    'id'           => 'custom_ids',
                    'type'         => 'select2',
                    'label'        => __('List by IDs'),
                    'select2'      => [
                        'ajax'     => [
                            'url'      => route('community.admin.getForSelect2'),
                            'dataType' => 'json'
                        ],
                        'width'    => '100%',
                        'multiple' => "true",
                        'placeholder' => __('-- Select --')
                    ],
                    'pre_selected' => route('community.admin.getForSelect2', [
                        'pre_selected' => 1
                    ])
                ],
            ],
            'category'=>__("Service Community")
        ];
    }

    public function getName()
    {
        return __('Community: List Items');
    }

    public function content($model = [])
    {
        $list = $this->query($model);
        $data = [
            'rows'       => $list,
            'style_list' => $model['style'],
            'title'      => $model['title'] ?? "",
            'desc'      => $model['desc'] ?? "",
        ];
        return view('Community::frontend.blocks.list-community.index', $data);
    }

    public function contentAPI($model = []){
        $rows = $this->query($model);
        $model['data']= $rows->map(function($row){
            return $row->dataForApi();
        });
        return $model;
    }

    public function query($model){
        $model_Community = Community::select("bravo_communitys.*")->with(['location','translations','hasWishList']);
        if(empty($model['order'])) $model['order'] = "id";
        if(empty($model['order_by'])) $model['order_by'] = "desc";
        if(empty($model['number'])) $model['number'] = 5;
        if (!empty($model['location_id'])) {
            $location = Location::where('id', $model['location_id'])->where("status","publish")->first();
            if(!empty($location)){
                $model_Community->join('bravo_locations', function ($join) use ($location) {
                    $join->on('bravo_locations.id', '=', 'bravo_communitys.location_id')
                        ->where('bravo_locations._lft', '>=', $location->_lft)
                        ->where('bravo_locations._rgt', '<=', $location->_rgt);
                });
            }
        }
        if (!empty($model['category_id'])) {
            $category_ids = [$model['category_id']];
            $list_cat = CommunityCategory::whereIn('id', $category_ids)->where("status","publish")->get();
            if(!empty($list_cat) and $list_cat->count() > 0)
            {
                $where_left_right = [];
                $params = [];
                foreach ($list_cat as $cat){
                    $where_left_right[] = " ( bravo_community_category._lft >= ? AND bravo_community_category._rgt <= ? ) ";
                    $params[] = $cat->_lft;
                    $params[] = $cat->_rgt;
                }
                $sql_where_join = " ( ".implode("OR" , $where_left_right)." )  ";
                $model_Community
                    ->join('bravo_community_category', function ($join) use($sql_where_join,$params) {
                        $join->on('bravo_community_category.id', '=', 'bravo_communitys.category_id')
                            ->WhereRaw($sql_where_join,$params);
                    });
            }
        }
        if(!empty($model['is_featured']))
        {
            $model_Community->where('bravo_communitys.is_featured',1);
        }
        if(!empty( $model['custom_ids'] )){
            $model_Community->whereIn("bravo_communitys.id",$model['custom_ids']);
        }
        $model_Community->orderBy("bravo_communitys.".$model['order'], $model['order_by']);
        $model_Community->where("bravo_communitys.status", "publish");
        $model_Community->with('location');
        $model_Community->groupBy("bravo_communitys.id");
        return $model_Community->limit($model['number'])->get();
    }
}
