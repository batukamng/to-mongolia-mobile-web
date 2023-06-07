@extends('layouts.app')
@push('css')
    <link href="{{ asset('dist/frontend/module/tour/css/tour.css?_ver='.config('app.asset_version')) }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset("libs/ion_rangeslider/css/ion.rangeSlider.min.css") }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset("libs/fotorama/fotorama.css") }}"/>
@endpush
@section('content')
    <div class="bravo_detail_tour">
        @include('Layout::parts.bc')
        @include('Tour::frontend.layouts.details.tour-banner')
        <div class="bravo_content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-9">
                        @php $review_score = $row->review_data @endphp
                        @include('Tour::frontend.layouts.details.tour-detail')
                        <?php
                        //if(!setting_item('tour_enable_inbox')) return;
                        $vendor = $row->vendor;
                        ?>
                            <div class="owner-info widget-box" style="margin-bottom:10px;">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="{{route('user.profile',['id'=>$vendor->user_name ?? $vendor->id])}}" class="avatar-cover" style="background-image: url('{{$vendor->getAvatarUrl()}}')" >
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading"><a class="author-link" href="{{route('user.profile',['id'=>$vendor->user_name ?? $vendor->id])}}">{{$vendor->getDisplayName()}}</a>
                                            @if($vendor->is_verified)
                                                <img data-toggle="tooltip" data-placement="top" src="{{asset('icon/ico-vefified-1.svg')}}" title="{{__("Verified")}}" alt="{{__("Verified")}}">
                                            @else
                                                <img data-toggle="tooltip" data-placement="top" src="{{asset('icon/ico-not-vefified-1.svg')}}" title="{{__("Not verified")}}" alt="{{__("Verified")}}">
                                            @endif
                                        </h4>
                                        <p>{{ __("Member Since :time",["time"=> date("M Y",strtotime($vendor->created_at))]) }}</p>
                                        <h4 class="media-heading"><a class="author-link" href="{{route('user.profile',['id'=>$vendor->user_name ?? $vendor->id])}}">{{$vendor->getDisplayName()}}</a>
                                            {{$vendor->bio}}
                                        </h4>
                                        @if((!Auth::check() or Auth::id() != $row->create_user ) and setting_item('inbox_enable'))
                                            <a class="btn bc_start_chat" href="{{route('user.chat',['user_id'=>$row->create_user])}}" ><i class="icon ion-ios-chatboxes"></i> {{__('Message host')}}</a>
                                        @endif
                                        <a href="{{route('user.profile',['id'=>$vendor->user_name ?? $vendor->id])}}">
                                            For more ->
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @include('Tour::frontend.layouts.details.tour-review')
                    </div>
                    <div class="col-md-12 col-lg-3">
                        @include('Tour::frontend.layouts.details.vendor')
                        @include('Tour::frontend.layouts.details.tour-form-book')
                        @include('Tour::frontend.layouts.details.open-hours')
                    </div>
                </div>
                <div class="row end_tour_sticky">
                    <div class="col-md-12">
                        @include('Tour::frontend.layouts.details.tour-related')
                    </div>
                </div>
            </div>
        </div>
        <div class="bravo-more-book-mobile">
            <div class="container">
                <div class="left">
                    <div class="g-price">
                        <div class="prefix">
                            <span class="fr_text">{{__("from")}}</span>
                        </div>
                        <div class="price">
                            <span class="onsale">{{ $row->display_sale_price }}</span>
                            <span class="text-price">{{ $row->display_price }}</span>
                        </div>
                    </div>
                    @if(setting_item('tour_enable_review'))
                    <?php
                    $reviewData = $row->getScoreReview();
                    $score_total = $reviewData['score_total'];
                    ?>
                    <div class="service-review tour-review-{{$score_total}}">
                        <div class="list-star">
                            <ul class="booking-item-rating-stars">
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                            </ul>
                            <div class="booking-item-rating-stars-active" style="width: {{  $score_total * 2 * 10 ?? 0  }}%">
                                <ul class="booking-item-rating-stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                </ul>
                            </div>
                        </div>
                        <span class="review">
                        @if($reviewData['total_review'] > 1)
                                {{ __(":number Reviews",["number"=>$reviewData['total_review'] ]) }}
                            @else
                                {{ __(":number Review",["number"=>$reviewData['total_review'] ]) }}
                            @endif
                    </span>
                    </div>
                    @endif
                </div>
                <div class="right">
                    @if($row->getBookingEnquiryType() === "book")
                        <a class="btn btn-primary bravo-button-book-mobile">{{__("Book Now")}}</a>
                    @else
                        <a class="btn btn-primary" data-toggle="modal" data-target="#enquiry_form_modal">{{__("Contact Now")}}</a>
                   @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    {!! App\Helpers\MapEngine::scripts() !!}
    <script>
        jQuery(function ($) {
            @if($row->map_lat && $row->map_lng)
            new BravoMapEngine('map_content', {
                disableScripts: true,
                fitBounds: true,
                center: [{{$row->map_lat}}, {{$row->map_lng}}],
                zoom:{{$row->map_zoom ?? "8"}},
                ready: function (engineMap) {
                    engineMap.addMarker([{{$row->map_lat}}, {{$row->map_lng}}], {
                        icon_options: {
                            iconUrl:"{{get_file_url(setting_item("tour_icon_marker_map"),'full') ?? url('images/icons/png/pin.png') }}"
                        }
                    });
                }
            });
            @endif
        })
    </script>
    <script>
        var bravo_booking_data = {!! json_encode($booking_data) !!}
        var bravo_booking_i18n = {
                no_date_select:'{{__('Please select Start date')}}',
                no_guest_select:'{{__('Please select at least one guest')}}',
                load_dates_url:'{{route('tour.vendor.availability.loadDates')}}',
                name_required:'{{ __("Name is Required") }}',
                email_required:'{{ __("Email is Required") }}',
            };
    </script>
    <script type="text/javascript" src="{{ asset("libs/ion_rangeslider/js/ion.rangeSlider.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset("libs/fotorama/fotorama.js") }}"></script>
    <script type="text/javascript" src="{{ asset("libs/sticky/jquery.sticky.js") }}"></script>
    <script type="text/javascript" src="{{ asset('module/tour/js/single-tour.js?_ver='.config('app.asset_version')) }}"></script>
@endpush
