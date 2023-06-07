<div class="bravo-form-search-tour {{$style}} @if(!empty($style) and $style == "carousel") bravo-form-search-slider @endif" @if(empty($style)) style="background-image: linear-gradient(0deg,rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.2)),url('{{$bg_image_url}}') !important" @endif>
    @if(in_array($style,['carousel','']))
        @include("Tour::frontend.blocks.form-search-tour.style-normal")
    @endif
    @if($style == "carousel_v2")
        @include("Tour::frontend.blocks.form-search-tour.style-slider-ver2")
    @endif
</div>
<div class="profile-service-tabs">
    <div class="service-nav-tabs">
        <ul class="nav nav-tabs" id="myTab" role="tablist" style="justify-content: center; margin-top:20px; margin-bottom:20px;">
            <li class="nav-item" href="/tour" style="text-align: center;">
                <img data-toggle="tooltip" data-placement="top" src="{{asset('icon/daytour.svg')}}">
                <a href="/tour" style="text-align:center; color:black;" class="nav-link" data-toggle="/tour" role="tab" aria-controls="guide" aria-selected="true">Day tour</a>
            </li>
            <li class="nav-item" href="page/tour" style="text-align: center;">
                <img data-toggle="tooltip" href="page/tour" data-placement="top" src="{{asset('icon/package.svg')}}">
                <a href="page/tour" style="text-align:center; color:black;" class="nav-link" data-toggle="page/tour" role="tab" aria-controls="company" aria-selected="true">Package</a>
            </li>
            <li class="nav-item" href="/news/Activity" style="text-align: center;">
                <img data-toggle="tooltip" data-placement="top" src="{{asset('icon/activity.svg')}}">
                <a href="/news/Activity" style="text-align:center; color:black;" class="nav-link" data-toggle="/news/Activity" role="tab" aria-controls="guide" aria-selected="true">Activity</a>
            </li>
            <li class="nav-item" href="/news/Restaurant" style="text-align: center;">
                <img data-toggle="tooltip" data-placement="top" src="{{asset('icon/food.svg')}}">
                <a href="/news/Restaurant" style="text-align:center; color:black;" class="nav-link" data-toggle="/news/Restaurant" role="tab" aria-controls="guide" aria-selected="true">Restaurant</a>
            </li>
            <li class="nav-item" href="/news/Hotel&House" style="text-align: center;">
                <img data-toggle="tooltip" data-placement="top" src="{{asset('icon/hotelhouse.svg')}}">
                <a href="/news/Hotel&House" style="text-align:center; color:black;" class="nav-link" data-toggle="/news/Hotel&House" role="tab" aria-controls="guide" aria-selected="true">Hotel&House</a>
            </li>
        </ul>
    </div>
</div>