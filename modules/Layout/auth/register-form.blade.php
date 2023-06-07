<form class="form bravo-form-register" method="post" action="{{route('auth.register.store')}}">
    @csrf
    <!-- <div class="row">
        <div class="col-lg-12 col-md-12" hidden>
            <div class="form-group">
                <input type="text" class="form-control" name="first_name" autocomplete="off" placeholder="{{__("First Name")}}">
                <i class="input-icon field-icon icofont-waiter-alt"></i>
                <span class="invalid-feedback error error-first_name"></span>
            </div>
        </div>
        <div class="col-lg-6 col-md-12" hidden>
            <div class="form-group">
                <input type="text" class="form-control" name="last_name" autocomplete="off" placeholder="{{__("Last Name")}}">
                <i class="input-icon field-icon icofont-waiter-alt"></i>
                <span class="invalid-feedback error error-last_name"></span>
            </div>
        </div>
    </div>
    
    <div class="form-group" hidden>
        <input type="text" class="form-control" name="phone" autocomplete="off" placeholder="{{__('Phone')}}">
        <i class="input-icon field-icon icofont-ui-touch-phone"></i>
        <span class="invalid-feedback error error-phone"></span>
    </div> -->
    <div class="form-group">
        <input type="email" class="form-control loginfield" name="email" autocomplete="off" placeholder="{{__('Email address')}}" style="border: none; border-bottom: 1px solid #DAE1E7; outline: none;">
        <i class="input-icon field-icon icofont-mail loginicons"></i>
        <span class="invalid-feedback error error-email"></span>
    </div>
    <div class="form-group">
        <input type="password" class="form-control loginfield" name="password" autocomplete="off" placeholder="{{__('Password')}}" style="border: none; border-bottom: 1px solid #DAE1E7; outline: none;">
        <i class="input-icon field-icon icofont-ui-password loginicons"></i>
        <span class="invalid-feedback error error-password"></span>
    </div>
    <div class="form-group">
        <label for="term">
            <input id="term" type="checkbox" name="term" class="mr5">
            {!! __("I have read and accept the <a href=':link' target='_blank'>Terms and Privacy Policy</a>",['link'=>get_page_url(setting_item('booking_term_conditions'))]) !!}
            <span class="checkmark fcheckbox"></span>
        </label>
        <div><span class="invalid-feedback error error-term"></span></div>
    </div>
    @if(setting_item("user_enable_register_recaptcha"))
        <div class="form-group">
            {{recaptcha_field($captcha_action ?? 'register')}}
        </div>
        <div><span class="invalid-feedback error error-g-recaptcha-response"></span></div>
    @endif
    <div class="error message-error invalid-feedback"></div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary form-submit">
            {{ __('Sign Up') }}
            <span class="spinner-grow spinner-grow-sm icon-loading" role="status" aria-hidden="true"></span>
        </button>
    </div>
    
    <div class="c-grey f14 text-center">
        <label>
            {{" Become a partner with us. "}}
        <a href="/page/become-a-vendor">{{"Sign up"}}</a>
        </label>
    </div>
    <div class="c-grey f14 text-center" style="margin-top: 15px;">
        <label>
            {{" Or "}}
        </label>
    </div>
    @if(setting_item('facebook_enable') or setting_item('google_enable') or setting_item('twitter_enable') or setting_item('kakao_enable'))
        <div class="advanced" style="margin-top:0px; padding:20px; background:none;">
            <div class="row">
                @if(setting_item('facebook_enable'))
                    <div class="col-xs-12 col-sm-3">
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <a href="{{url('/social-login/facebook')}}"class="btn btn_login_fb_link" data-channel="facebook" style="border-radius:50px; height: 48px; padding: 12px 0px 0px 0px;">
                            <i class="input-icon fa fa-facebook" style="font-size: 25px;"></i>
                        </a>
                    </div>
                @endif
                @if(setting_item('google_enable'))
                    <div class="col-xs-12 col-sm-2">
                        <a href="{{url('social-login/google')}}" class="btn btn_login_gg_link" data-channel="google" style="border-radius:50px; height: 48px; padding: 12px 0px 0px 0px;">
                            <i class="input-icon fa fa-google" style="font-size: 25px;"></i>
                        </a>
                    </div>
                @endif
                @if(setting_item('kakao_enable'))
                    <div class="col-xs-12 col-sm-2">
                        <a href="{{url('social-login/kakao')}}" class="btn btn_login_kt_link" data-channel="kakao" style="border-radius:50px; height: 48px; padding: 12px 0px 0px 0px;">
                            <i class="input-icon fa fa-comment" style="font-size: 25px;"></i>
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                    </div>
                @endif
            </div>
        </div>
    @endif
</form>
