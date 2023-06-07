<?php
namespace Modules\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Location\Models\Location;
use Modules\Media\Helpers\FileHelper;

class SubFeatures extends BaseBlock
{
    public function getName()
    {
        return __('To Mongolia: Sub Features');
    }

    public function getOptions()
    {
        return [
            'settings' => [
                [
                    'id'            => 'style',
                    'type'          => 'radios',
                    'label'         => __('Display Style'),
                    'values'        => [
                        [
                            'value'   => 'icon',
                            'name' => __("Icon Style")
                        ],
                        [
                            'value'   => 'tab',
                            'name' => __("Tabbed Center")
                        ],
                        [
                            'value'   => 'tab-left',
                            'name' => __("Tabbed Left")
                        ],
                        [
                            'value'   => 'tab-right',
                            'name' => __("Tabbed Right")
                        ]
                    ]
                ],
                [
                    'id'          => 'list_item',
                    'type'        => 'listItem',
                    'label'       => __('List Item(s)'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'        => 'title',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Title')
                        ],
                        [
                            'id'        => 'link',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Link')
                        ],
                        [
                            'id'        => 'icon',
                            'type'      => 'input',
                            'inputType' => 'textArea',
                            'label'     => __('SVG Icon')
                        ],
                        [
                            'id'        => 'class',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Class')
                        ]
                    ]
                ],
            ],
            'category'=>__("To Mongolia")
        ];
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.sub-features.index', $model);
    }
}
