<div class="bravo-form-search-boat @if(!empty($style) and $style == "boatousel") bravo-form-search-slider @endif" @if(empty($style)) style="background-image: linear-gradient(0deg,rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.2)),url('{{$bg_image_url}}') !important" @endif>
    @if(!empty($style) and $style == "boatousel" and !empty($list_slider))
        <div class="effect">
            <div class="owl-boatousel">
                @foreach($list_slider as $item)
                    @php $img = get_file_url($item['bg_image'],'full') @endphp
                    <div class="item">
                        <div class="item-bg" style="background-image: linear-gradient(0deg,rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.2)),url('{{$img}}') !important"></div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="text-heading text-center">{{$title}}</h1>
                <h2 class="sub-heading text-center">{{$sub_title}}</h2>
            </div>
        </div>
    </div>
</div>
<div class="profile-service-tabs">
    <div class="service-nav-tabs">
        <ul class="nav nav-tabs" id="myTab" role="tablist" style="justify-content: center; margin-top:20px; margin-bottom:20px;">
            <li class="nav-item" href="/news/home-space" style="text-align: center;">
                <img data-toggle="tooltip" href="/news/Translator" data-placement="top" src="{{asset('icon/translate.svg')}}">
                <a href="/news/Translator" style="text-align:center; color:black;" class="nav-link" data-toggle="/news/Translator" role="tab" aria-controls="company" aria-selected="true">Translator</a>
            </li>
            <li class="nav-item" href="/news/Vehicle" style="text-align: center;">
                <img data-toggle="tooltip" data-placement="top" src="{{asset('icon/vehicle.svg')}}">
                <a href="/news/Vehicle" style="text-align:center; color:black;" class="nav-link" data-toggle="/news/Vehicle" role="tab" aria-controls="guide" aria-selected="true">Vehicle</a>
            </li>
            <li class="nav-item" href="/news/Hotel" style="text-align: center;">
                <img data-toggle="tooltip" data-placement="top" src="{{asset('icon/hotel.svg')}}">
                <a href="/news/Hotel" style="text-align:center; color:black;" class="nav-link" data-toggle="/news/Hotel" role="tab" aria-controls="guide" aria-selected="true">Hotel</a>
            </li>
            <li class="nav-item" href="/news/Tour" style="text-align: center;">
                <img data-toggle="tooltip" data-placement="top" src="{{asset('icon/tour1.svg')}}">
                <a href="/news/Tour" style="text-align:center; color:black;" class="nav-link" data-toggle="/news/Tour" role="tab" aria-controls="guide" aria-selected="true">Tour</a>
            </li>
            <li class="nav-item" href="/news/Food" style="text-align: center;">
                <img data-toggle="tooltip" data-placement="top" src="{{asset('icon/food1.svg')}}">
                <a href="/news/Food" style="text-align:center; color:black;" class="nav-link" data-toggle="/news/Food" role="tab" aria-controls="guide" aria-selected="true">Food</a>
            </li>
            <li class="nav-item" href="/news/Finance" style="text-align: center;">
                <img data-toggle="tooltip" data-placement="top" src="{{asset('icon/finance.svg')}}">
                <a href="/news/Finance" style="text-align:center; color:black;" class="nav-link" data-toggle="/news/Finance" role="tab" aria-controls="guide" aria-selected="true">Finance</a>
            </li>
        </ul>
    </div>
</div>