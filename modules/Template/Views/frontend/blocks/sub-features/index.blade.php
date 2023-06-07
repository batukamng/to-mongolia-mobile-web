@if($list_item)
    @if ($style == 'icon')
        @include('Template::frontend.blocks.sub-features.style-icon')
    @elseif ($style == 'tab-left')
        @include('Template::frontend.blocks.sub-features.style-tab-left')
    @elseif ($style == 'tab-right')
        @include('Template::frontend.blocks.sub-features.style-tab-right')
    @else
        @include('Template::frontend.blocks.sub-features.style-tab-center')
    @endif
@endif
