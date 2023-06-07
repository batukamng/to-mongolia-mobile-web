@if($row->getGallery())
    <div class="g-gallery">
        <div class="fotorama" data-width="100%" data-thumbwidth="135" data-thumbheight="135" data-thumbmargin="15" data-nav="thumbs" data-allowfullscreen="true">
            @foreach($row->getGallery() as $key=>$item)
                <a href="{{$item['large']}}" data-thumb="{{$item['thumb']}}" data-alt="{{ __("Gallery") }}"></a>
            @endforeach
        </div>
        <div class="social">
            <div class="social-share">
                <span class="social-icon">
                    <i class="icofont-share"></i>
                </span>
                <ul class="share-wrapper">
                    <li>
                        <a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u={{$row->getDetailUrl()}}&amp;title={{$translation->title}}" target="_blank" rel="noopener" original-title="{{__("Facebook")}}">
                            <i class="fa fa-facebook fa-lg"></i>
                        </a>
                    </li>
                    <li>
                        <a class="twitter" href="https://twitter.com/share?url={{$row->getDetailUrl()}}&amp;title={{$translation->title}}" target="_blank" rel="noopener" original-title="{{__("Twitter")}}">
                            <i class="fa fa-twitter fa-lg"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="service-wishlist {{$row->isWishList()}}" data-id="{{$row->id}}" data-type="{{$row->type}}">
                <i class="fa fa-heart-o"></i>
            </div>
        </div>
    </div>
@endif
<div class="g-header">
    <div class="left">
        <h1>{!! clean($translation->title) !!}</h1>
    </div>
</div>
@if(!empty($row->duration) or !empty($row->category_community->name) or !empty($row->max_people) or !empty($row->location->name))
    <div class="g-community-feature" style="border:1px solid #D7DCE3; padding:0px; padding-left:20px!important; border-radius:10px;">
    <div class="row">
            <div class="col-xs-6 col-lg-6 col-md-6">
                <div class="item">
                    <div class="icon">
                        <i class="icofont-tasks-alt" style="font-size:30px;"></i>  
                    </div>
                    <div class="info" style="padding-top:10px;">
                        <!-- <h4 class="name">{{__("Duration")}}</h4> -->
                        @if(empty($row->start_date))
                            <h4 class="name">{{__("Duration")}}</h4>
                        @endif
                        <p class="value">
                        @if($row->start_date)
                            {{$row->start_date->toDateString()}} - {{$row->end_date->toDateString()}}
                        @endif
                        </p>
                    </div>
                </div>
            </div>
        @if(!empty($row->location->name))
                @php $location =  $row->location->translateOrOrigin(app()->getLocale()) @endphp
            <div class="col-xs-6 col-lg-6 col-md-6">
                <div class="item">
                    <div class="icon">
                        <i class="icofont-users-alt-3" style="font-size:30px;"></i>
                    </div>
                    <div class="info" style="padding-top:10px;">
                    <div class="duration">
                        <span style="font-size: 14px;">{{$row->min_people}}/{{$row->max_people}}</span>
                    </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endif
@if($translation->content)
    <div class="g-overview">
        <h3>{{__("Overview")}}</h3>
        <div class="description">
            <?php echo $translation->content ?>
        </div>
    </div>
@endif
@include('Community::frontend.layouts.details.community-attributes')
@include('Community::frontend.layouts.details.community-itinerary')

<!-- @include('Community::frontend.layouts.details.community-include-exclude') -->
<!-- @include('Community::frontend.layouts.details.community-faqs') -->
@include('Hotel::frontend.layouts.details.hotel-surrounding')

@if($row->map_lat && $row->map_lng)
<div class="g-location">
</div>
@endif
