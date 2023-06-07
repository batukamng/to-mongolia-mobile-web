@php
    $translation = $row->translateOrOrigin(app()->getLocale());
@endphp
<div class="item-loop {{$wrap_class ?? ''}}" style="border-radius:5px; margin-bottom:0px;">
    @if($row->is_featured == "1")
        <div class="featured">
            {{__("Featured")}}
        </div>
    @endif
    <div class="thumb-image ">
        <a @if(!empty($blank)) target="_blank" @endif href="{{$row->getDetailUrl()}}">
            @if($row->image_url)
                @if(!empty($disable_lazyload))
                    <img src="{{$row->image_url}}" class="img-responsive" alt="">
                @else
                    {!! get_image_tag($row->image_id,'medium',['class'=>'img-responsive','alt'=>$translation->title]) !!}
                @endif
            @endif
        </a>
        @if($row->star_rate)
            <div class="star-rate" style="width:85%;">
                <div class="list-star">
                    <ul class="booking-item-rating-stars" style="width:100%; color:white;">
                        <!-- @for ($star = 1 ;$star <= $row->star_rate ; $star++)
                            <li><i class="fa fa-star"></i></li>
                        @endfor -->
                        <li><i class="fa fa-star"></i></li>
                        <li><i>
                        @if(setting_item('hotel_enable_review'))
                            <?php
                            $reviewData = $row->getScoreReview();
                            $score_total = $reviewData['score_total'];
                            ?>
                            <div style="font-style:normal;">
                                <span class="rate">
                                    @if($reviewData['total_review'] > 0) {{$score_total}} @endif
                                </span>
                                <span class="review">(
                                    @if($reviewData['total_review'] > 1)
                                        {{ __(":number ",["number"=>$reviewData['total_review'] ]) }}
                                    @else
                                        {{ __(":number ",["number"=>$reviewData['total_review'] ]) }}
                                    @endif)
                                </span>
                                <span>
                                    @if(!empty($row->location->name))
                                        @php $location =  $row->location->translateOrOrigin(app()->getLocale()) @endphp
                                        {{$location->name ?? ''}}
                                    @endif
                                </span>
                            </div>
                        @endif
                        </i></li>
                    </ul>
                </div>
            </div>
        @endif
        <div class="service-wishlist {{$row->isWishList()}}" data-id="{{$row->id}}" data-type="{{$row->type}}">
            <i class="fa fa-heart" style="font-size:20px;"></i>
            <!-- <svg width="20px" height="20px" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M20.84 4.496a5.5 5.5 0 0 0-7.78 0L12 5.556l-1.06-1.06a5.501 5.501 0 0 0-7.78 7.78l1.06 1.06 7.78 7.78 7.78-7.78 1.06-1.06a5.502 5.502 0 0 0 0-7.78z" fill-opacity=".45" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg> -->
        </div>
    </div>
    <div class="item-content" style="padding-left:15px;">
        <div class="item-title" style="padding: 10px 0 0 0;">
            <strong style="font-size:14px;" @if(!empty($blank)) target="_blank" @endif href="{{$row->getDetailUrl()}}">
                @if($row->is_instant)
                    <i class="fa fa-bolt d-none"></i>
                @endif
                    {!! clean($translation->title) !!}
            </strong>
            @if($row->discount_percent)
                <div class="sale_info">{{$row->discount_percent}}</div>
            @endif
        </div>
        <!-- <div class="location">
            @if(!empty($row->location->name))
                @php $location =  $row->location->translateOrOrigin(app()->getLocale()) @endphp
                {{$location->name ?? ''}}
            @endif
        </div> -->
        <!-- @if(setting_item('hotel_enable_review'))
        <?php
        $reviewData = $row->getScoreReview();
        $score_total = $reviewData['score_total'];
        ?>
        <div class="service-review">
            <span class="rate">
                @if($reviewData['total_review'] > 0) {{$score_total}} @endif
            </span>
            <span class="review">
                @if($reviewData['total_review'] > 1)
                    {{ __(":number Reviews",["number"=>$reviewData['total_review'] ]) }}
                @else
                    {{ __(":number Review",["number"=>$reviewData['total_review'] ]) }}
                @endif
            </span>
        </div>
        @endif -->
        <div class="info" style="padding:0px;">
            <div class="g-price">
                <!-- <div class="prefix">
                    <span class="fr_text">{{__("from")}}</span>
                </div> -->
                <div class="price">
                    <span style="font-size:14px;" class="text-price"><strong>{{ $row->display_price }} </strong><span style="font-size:14px;" class="unit">{{__("/night")}}</span></span>
                </div>
            </div>
        </div>
    </div>
    
</div>
