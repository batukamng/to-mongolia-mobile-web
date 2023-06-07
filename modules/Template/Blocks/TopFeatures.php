<?php
namespace Modules\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Location\Models\Location;
use Modules\Media\Helpers\FileHelper;

class TopFeatures extends BaseBlock
{
    public function getName()
    {
        return __('To Mongolia: Top Features');
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
                            'value'   => 'image',
                            'name' => __("Image Background")
                        ],
                        [
                            'value'   => 'icon',
                            'name' => __("Icon to Left")
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
                            'id'    => 'image_id',
                            'type'  => 'uploader',
                            'label' => __('Featured Image')
                        ],
                    ]
                ],
            ],
            'category'=>__("To Mongolia")
        ];
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.top-features.index', $model);
    }
}
