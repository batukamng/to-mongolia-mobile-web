<?php
namespace Modules\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Location\Models\Location;

class TipLocations extends BaseBlock
{
    public function getOptions()
    {
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
                    'id'            => 'order',
                    'type'          => 'radios',
                    'label'         => __('Order'),
                    'values'        => [
                        [
                            'value'   => 'id',
                            'name' => __("Date Create")
                        ],
                        [
                            'value'   => 'name',
                            'name' => __("Title")
                        ],
                    ],
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
                    ],
                ],
                [
                    'id'           => 'category_id',
                    'type'         => 'select2',
                    'label'        => __('List Location by Category'),
                    'select2'      => [
                        'ajax'     => [
                            'url'      => route('location.admin.getLocationCategory'),
                            'dataType' => 'json'
                        ],
                        'width'    => '100%',
                        'multiple' => "false",
                    ],
                ],
            ],
            'category'=>__("To Mongolia")
        ];
    }

    public function getName()
    {
        return __('To Mongolia: Tip Locations');
    }

    public function content($model = [])
    {
        $list = $this->query($model);
        $data = [
            'rows'         => $list,
            'title'        => $model['title'],
            'desc'         => $model['desc'] ?? "",
        ];
        return view('Template::frontend.blocks.tip-locations.index', $data);
    }

    public function contentAPI($model = []){
        $rows = $this->query($model);
        $model['data']= $rows->map(function($row){
            return $row->dataForApi();
        });
        return $model;
    }

    public function query($model){
        if(empty($model['order'])) $model['order'] = "id";
        if(empty($model['order_by'])) $model['order_by'] = "desc";
        if(empty($model['number'])) $model['number'] = 3;

        $model_location = Location::query()->with(['translations']);
        $model_location->where("status","publish");
        if(!empty( $model['category_id'] )){
            $model_location->where("category_id",$model['category_id']);
        }
        $model_location->orderBy($model['order'], $model['order_by']);
        return $model_location->limit($model['number'])->get();
    }
}
