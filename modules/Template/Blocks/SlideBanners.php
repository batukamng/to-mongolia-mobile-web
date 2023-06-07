<?php
namespace Modules\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Location\Models\Location;
use Modules\Media\Helpers\FileHelper;

class SlideBanners extends BaseBlock
{
    public function getName()
    {
        return __('To Mongolia: Slide Banners');
    }

    public function getOptions()
    {
        return [
            'settings' => [
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
        return view('Template::frontend.blocks.slide-banners.index', $model);
    }
}
