<div class="bravo-list-community {{$style_list}}">
    @if(in_array($style_list,['normal','carousel','box_shadow']))
        @include("Community::frontend.blocks.list-community.style-normal")
    @endif
    @if($style_list == "carousel_simple")
        @include("Community::frontend.blocks.list-community.style-carousel-simple")
    @endif
</div>