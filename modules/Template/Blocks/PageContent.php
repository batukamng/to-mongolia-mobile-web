<?php
namespace Modules\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Location\Models\Location;
use Modules\Media\Helpers\FileHelper;
use Modules\Page\Models\Page;

class PageContent extends BaseBlock
{
    public function getName()
    {
        return __('To Mongolia: Page Content');
    }

    public function getOptions()
    {
        return [
            'settings' => [
                [
                    'id'        => 'class',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Wrapper Class (opt)')
                ],
            ],
            'category'=>__("To Mongolia")
        ];
    }

    public function content($model = [])
    {
        $slug = request()->route('slug');

        $page = Page::where('slug', $slug)->first();
        $translation = $page->translateOrOrigin(app()->getLocale());
        $model['content'] = $page ? $translation->content : '';

        return view('Template::frontend.blocks.page-content.index', $model);
    }
}
