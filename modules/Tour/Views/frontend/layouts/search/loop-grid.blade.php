@php
    $translation = $row->translateOrOrigin(app()->getLocale());
@endphp
<div class="item-tour {{$wrap_class ?? ''}}" style="margin-bottom:0px;">
    @if($row->is_featured == "1")
        <div class="featured">
            {{__("Featured")}}
        </div>
    @endif
    <div class="thumb-image">
        @if($row->discount_percent)
            <div class="sale_info">{{$row->discount_percent}}</div>
        @endif
        <a @if(!empty($blank)) target="_blank" @endif href="{{$row->getDetailUrl($include_param ?? true)}}">
            @if($row->image_url)
                @if(!empty($disable_lazyload))
                    <img src="{{$row->image_url}}" class="img-responsive" alt="{{$location->name ?? ''}}">
                @else
                    {!! get_image_tag($row->image_id,'medium',['class'=>'img-responsive','alt'=>$row->title]) !!}
                @endif
            @endif
        </a>
        <div class="service-wishlist {{$row->isWishList()}}" data-id="{{$row->id}}" data-type="{{$row->type}}">
            <i class="fa fa-heart" style="font-size:20px;"></i>
        </div>
    </div>
    <div class="item-content" style="padding-top: 10px; padding-bottom:16px;">
        <!-- <div class="location">
            @if(!empty($row->location->name))
                @php $location =  $row->location->translateOrOrigin(app()->getLocale()) @endphp
                <i class="icofont-paper-plane"></i>
                {{$location->name ?? ''}}
            @endif
        </div> -->
        <div class="item-title" style="min-height:48px;">
            <a @if(!empty($blank)) target="_blank" @endif href="{{$row->getDetailUrl($include_param ?? true)}}">
            {{Str::limit($translation->title, 40);}}
                <!-- {!! clean($translation->title) !!} -->
            </a>
        </div>
        <div class="info">
            <div class="g-price" style="display: inline-flex; width: auto; text-align:left;">
                <div class="price">
                    <!--<span class="onsale">{{ $row->display_sale_price }}</span>-->
                    <span class="text-price">{{ $row->display_price }}</span>
                </div>
            </div>
            <div class="duration" style="flex:none;  text-align:right;">
                <svg width="15" height="15" viewBox="0 0 15 15" stroke="currentColor" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.5 7.5 5.008 5.423c-.37-.308-.556-.463-.69-.652a1.75 1.75 0 0 1-.258-.552C4 3.995 4 3.754 4 3.272V1.667M7.5 7.5l2.493-2.077c.37-.308.555-.463.688-.652a1.75 1.75 0 0 0 .259-.552c.06-.224.06-.465.06-.947V1.667M7.5 7.5 5.008 9.577c-.37.309-.556.463-.69.652a1.75 1.75 0 0 0-.258.553c-.06.223-.06.464-.06.946v1.606M7.5 7.5l2.493 2.077c.37.309.555.463.688.652.118.168.206.355.259.553.06.223.06.464.06.946v1.606M2.833 1.667h9.334M2.833 13.334h9.334" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>                
                <!-- <span>{{duration_format($row->duration)}}</span> -->
                @if($row->category_id==5)
                    <span>{{$row->duration}} H</span>
                @else
                    <span>{{$row->duration}} D</span>
                @endif
            </div>
        </div>
    </div>
</div>
