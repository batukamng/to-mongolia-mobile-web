@if(!is_api())
	<div class="bravo_footer">
		@if (setting_item('enable_mailchimp') and setting_item_with_lang('mailchimp_api_key') and setting_item_with_lang('mailchimp_list_id'))
		<div class="mailchimp">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-lg-10 col-lg-offset-1">
						<div class="row">
							<div class="col-xs-12  col-md-7 col-lg-6">
								<div class="media ">
									<div class="media-left hidden-xs">
										<i class="icofont-island-alt"></i>
									</div>
									<div class="media-body">
										<h4 class="media-heading">{{__("Get Updates & More")}}</h4>
										<p>{{__("Thoughtful thoughts to your inbox")}}</p>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-md-5 col-lg-6">
								<form action="{{route('newsletter.subscribe')}}" class="subcribe-form bravo-subscribe-form bravo-form">
									@csrf
									<div class="form-group">
										<input type="text" name="email" class="form-control email-input" placeholder="{{__('Your Email')}}">
										<button type="submit" class="btn-submit">{{__('Subscribe')}}
											<i class="fa fa-spinner fa-pulse fa-fw"></i>
										</button>
									</div>
									<div class="form-mess"></div>
								</form>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif

		<div class="main-footer">
			<div class="container">
				<div class="bravo-footer-v2">
					<div class="d-none d-lg-flex align-items-center">
						<a href="{{url(app_get_locale(false,'/'))}}" class="bravo-logo">
							@php
								$logo_id = setting_item("logo_id");
								if(!empty($row->custom_logo)){
									$logo_id = $row->custom_logo;
								}
							@endphp
							@if($logo_id)
								<?php $logo = get_file_url($logo_id,'full') ?>
								<img src="{{$logo}}" alt="{{setting_item("site_title")}}">
							@endif
						</a>
					</div>
					<div class="bravo-footer-site-links">
						<a href="/page/privacy-policy">개인 정보 정책</a>
						<a href="/page/contact-us">문의하기</a>
					</div>
					<div class="bravo-app-links">
						<a href="{{ setting_item('appstore_link') ?? '#' }}" class="bravo-appstore">
							<img src="/dist/frontend/images/appstore.png" alt="App Store">
						</a>
						<a href="{{ setting_item('appstore_link') ?? '#' }}" class="bravo-playstore">
							<img src="/dist/frontend/images/playstore.png" alt="Play Store">
						</a>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="copy-right">
				<div class="context">
					<div class="row">
						<div class="col-md-12">
							{!! clean(setting_item_with_lang("footer_text_left"))  !!}
							<div class="f-visa">
								{!! clean(setting_item_with_lang("footer_text_right"))  !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endif

@include('Layout::parts.login-register-modal')
@include('Layout::parts.chat')
@include('Popup::frontend.popup')
@if(Auth::check())
	@include('Media::browser')
@endif
<link rel="stylesheet" href="{{asset('libs/flags/css/flag-icon.min.css')}}">

{!! \App\Helpers\Assets::css(true) !!}

{{--Lazy Load--}}
<script src="{{asset('libs/lazy-load/intersection-observer.js')}}"></script>
<script async src="{{asset('libs/lazy-load/lazyload.min.js')}}"></script>
<script>
    // Set the options to make LazyLoad self-initialize
    window.lazyLoadOptions = {
        elements_selector: ".lazy",
        // ... more custom settings?
    };

    // Listen to the initialization event and get the instance of LazyLoad
    window.addEventListener('LazyLoad::Initialized', function (event) {
        window.lazyLoadInstance = event.detail.instance;
    }, false);


</script>
<script src="{{ asset('libs/lodash.min.js') }}"></script>
<script src="{{ asset('libs/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('libs/vue/vue'.(!env('APP_DEBUG') ? '.min':'').'.js') }}"></script>
<script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('libs/bootbox/bootbox.min.js') }}"></script>
@if(Auth::check())
	<script src="{{ asset('module/media/js/browser.js?_ver='.config('app.asset_version')) }}"></script>
@endif
<script src="{{ asset('libs/carousel-2/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset("libs/daterange/moment.min.js") }}"></script>
<script type="text/javascript" src="{{ asset("libs/daterange/daterangepicker.min.js") }}"></script>
<script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('js/functions.js?_ver='.config('app.asset_version')) }}"></script>

@if(
    setting_item('tour_location_search_style')=='autocompletePlace' || setting_item('hotel_location_search_style')=='autocompletePlace' || setting_item('car_location_search_style')=='autocompletePlace' || setting_item('space_location_search_style')=='autocompletePlace' || setting_item('hotel_location_search_style')=='autocompletePlace' || setting_item('event_location_search_style')=='autocompletePlace'
)
	{!! App\Helpers\MapEngine::scripts() !!}
@endif
<script src="{{ asset('libs/pusher.min.js') }}"></script>
<script src="{{ asset('js/home.js?_ver='.config('app.asset_version')) }}"></script>

@if(!empty($is_user_page))
	<script src="{{ asset('module/user/js/user.js?_ver='.config('app.asset_version')) }}"></script>
@endif
@if(setting_item('cookie_agreement_enable')==1 and request()->cookie('booking_cookie_agreement_enable') !=1 and !is_api()  and !isset($_COOKIE['booking_cookie_agreement_enable']))
	<div class="booking_cookie_agreement p-3 d-flex fixed-bottom">
		<div class="content-cookie">{!! clean(setting_item_with_lang('cookie_agreement_content')) !!}</div>
		<button class="btn save-cookie">{!! clean(setting_item_with_lang('cookie_agreement_button_text')) !!}</button>
	</div>
	<script>
        var save_cookie_url = '{{route('core.cookie.check')}}';
	</script>
	<script src="{{ asset('js/cookie.js?_ver='.config('app.asset_version')) }}"></script>
@endif

@if(setting_item('user_enable_2fa'))
    @include('auth.confirm-password-modal')
    <script src="{{asset('/module/user/js/2fa.js')}}"></script>
@endif
<style>
	/* .owl-nav{
		display:none!important;
	} */
	/* .owl-nav.disabled{
		display:none!important;
	} */
	.sale_info{
		display:none;
	}
	.featured {
		display:none!important;
	}
	.col-xs-6 {
		width:50%;
	}
	.item-title {
		max-height:73px;
		/* min-height:73px; */
	}
	/* @media (min-width: 765px) {
  	.container .layout_carousel {
		margin-top:-50px;
		margin-bottom:-50px;
	}
	} */
	.profile-service-tabs .service-nav-tabs .nav .nav-item {
		width: 150px;
		}
	
	@media(max-width: 600px){
		.profile-service-tabs .service-nav-tabs .nav .nav-item {
		width:25%!important;
		}
	}
</style>
{!! \App\Helpers\Assets::js(true) !!}

@php \App\Helpers\ReCaptchaEngine::scripts() @endphp

@stack('js')
