@php
    $translation = $row->translateOrOrigin(app()->getLocale());
@endphp
<div class="item-community {{$wrap_class ?? ''}}" style="border-radius:5px;">
    @if($row->is_featured == "1")
        <div class="featured">
            {{__("Featured")}}
        </div>
    @endif
    <div class="thumb-image">
        @if($row->discount_percent)
            <div class="sale_info"  style="display:none;">{{$row->discount_percent}}</div>
        @endif
        <a @if(!empty($blank)) target="_blank" @endif href="{{$row->getDetailUrl($include_param ?? true)}}">
            @if($row->image_url)
                @if(!empty($disable_lazyload))
                    <img src="{{$row->image_url}}" class="img-responsive" alt="{{$location->name ?? ''}}">
                @else
                    {!! get_image_tag($row->image_id,'medium',['class'=>'img-responsive','alt'=>$row->title]) !!}
                @endif
            @else
                <img src="./public/images/default.png" class="img-responsive" alt="{{$location->name ?? ''}}">
            @endif
        </a>
        <div class="service-wishlist {{$row->isWishList()}}" data-id="{{$row->id}}" data-type="{{$row->type}}">
            <i class="fa fa-heart"></i>
        </div>
    </div>
    <div class="location">
        @if(!empty($row->enable_fixed_date))
        <i class="icofont-calendar"></i>  {{$row->start_date->toDateString()}} - {{$row->end_date->toDateString()}}     {{$location->name ?? ''}}
        @endif
    </div>
    <div class="item-title" style="padding-top:5px; min-height:auto;">
        <a href="{{$row->getDetailUrl($include_param ?? true)}}"><strong style="font-size: 14px;" @if(!empty($blank)) target="_blank" @endif href="{{$row->getDetailUrl($include_param ?? true)}}">
            {!! clean($translation->title) !!}
        </strong></a>
        <!-- <?php echo $translation->content ?> -->
    </div>
    <div class="location" style=" padding-top:0px;">
        <?php 
        $description1 = $translation->content;
        $description2 = substr($description1, 0, 30);
        echo $description2; 
        ?>
        <!-- <span>{{Str::limit($translation->content, 50);}}</span> -->
    </div>
    @if(setting_item('community_enable_review'))
    <?php
    $reviewData = $row->getScoreReview();
    $score_total = $reviewData['score_total'];
    ?>
    @endif
    <div class="info" style="">
        <div class="duration">
            <i class="icofont-users-alt-3"></i>
            <!-- <span style="font-size: 14px;">{{duration_format($row->duration)}}</span> -->
            <span style="font-size: 14px;">{{$row->min_people}}/{{$row->max_people}}</span>
        </div>
        <div class="g-price" style="padding-top: 5px;">
            <div class="prefix">
                <!-- <i class="icofont-flash"></i> -->
                <!-- <span style="font-size: 14px;" class="fr_text">{{__("from")}}</span> -->
            </div>
            <div class="price">
                <!-- <span style="font-size: 13px; padding-bottom:4px;" class="onsale">{{ $row->display_sale_price }}</span> -->
                <span style="font-size: 14px;" class="text-price">{{ $row->display_price }}</span>
            </div>
        </div>
    </div>
</div>
