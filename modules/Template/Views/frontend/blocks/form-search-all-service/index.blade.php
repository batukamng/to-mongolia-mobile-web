<div class="container">
    <div class="bravo-form-search-all {{$style}} @if(!empty($style) and $style == "carousel") bravo-form-search-slider @endif" @if(empty($style)) style="border-radius: 5px; height:270px;padding-bottom:0px!important; background-image: linear-gradient(0deg,rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.2)),url('{{$bg_image_url}}') !important" @endif>
        @if(in_array($style,['carousel','']))
            @include("Template::frontend.blocks.form-search-all-service.style-normal")
        @endif
        @if($style == "carousel_v2")
            @include("Template::frontend.blocks.form-search-all-service.style-slider-ver2")
        @endif
    </div>
</div>
