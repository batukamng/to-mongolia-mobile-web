@if($list_item)
    @if ($style == 'image')
        @include('Template::frontend.blocks.top-features.style-image')
    @endif

    @if ($style == 'icon')
        @include('Template::frontend.blocks.top-features.style-icon')
    @endif
@endif
