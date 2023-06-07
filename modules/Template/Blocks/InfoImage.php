<?php
namespace Modules\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Location\Models\Location;
use Modules\Media\Helpers\FileHelper;

class InfoImage extends BaseBlock
{
    public function getName()
    {
        return __('To Mongolia: Info Image');
    }

    public function getOptions()
    {
        return [
            'settings' => [
                [
                    'id'        => 'label',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Label Text')
                ],
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'id'        => 'desc',
                    'type'      => 'input',
                    'inputType' => 'textArea',
                    'label'     => __('Description')
                ],
                [
                    'id'        => 'button_text',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Button Text')
                ],
                [
                    'id'        => 'button_link',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Button Link')
                ],
                [
                    'id'    => 'image_id',
                    'type'  => 'uploader',
                    'label' => __('Featured Image')
                ],
                [
                    'id'            => 'style',
                    'type'          => 'radios',
                    'label'         => __('Display Style'),
                    'values'        => [
                        [
                            'value'   => 'left',
                            'name' => __("Image to Left")
                        ],
                        [
                            'value'   => 'right',
                            'name' => __("Image to Right")
                        ]
                    ]
                ],
            ],
            'category'=>__("To Mongolia")
        ];
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.info-image.index', $model);
    }
}
