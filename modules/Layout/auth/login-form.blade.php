<form class="bravo-form-login" method="POST" action="{{ route('login') }}">
    <input type="hidden" name="redirect" value="{{request()->query('redirect')}}">
    @csrf
    <div class="form-group">
        <i class=" icofont-email loginicons" style="position: absolute!important;
  top: 22px!important;
  left: 0px!important;
  font-size: 30px!important;
  transform: translateY(-50%)!important;
  color: #acb5be!important;
  line-height: 0px!important;"></i>
        <input type="text" class="loginfield" name="email" autocomplete="off" placeholder="{{__('Email')}}" style="border: none; border-bottom: 1px solid #DAE1E7!important; outline: none;height: 45px!important;
  box-shadow: none!important;
  border-radius: 3px!important;
  width: 90%!important;
  margin-left:10%!important;
  font-size: 14px!important;
  color: #5E6D77!important;">
        <span class="invalid-feedback error error-email"></span>
    </div>
    <div class="form-group">
        <input type="password" class="loginfield" name="password" autocomplete="off"  placeholder="{{__('Password')}}" style="border: none; border-bottom: 1px solid #DAE1E7!important; outline: none;height: 45px!important;
  box-shadow: none!important;
  border-radius: 3px!important;
  width: 90%!important;
  margin-left:10%!important;
  font-size: 14px!important;
  color: #5E6D77!important;">
        <i class=" icofont-lock loginicons" style="position: absolute!important;
  top: 22px!important;
  left: 0px!important;
  font-size: 30px!important;
  transform: translateY(-50%)!important;
  color: #acb5be!important;
  line-height: 0px!important;"></i>
        <span class="invalid-feedback error error-password"></span>
    </div>
    <div class="form-group">
        <div class="d-flex justify-content-between">
            <label for="remember-me" class="mb0">
                <input type="checkbox" name="remember" id="remember-me" value="1"> {{__('Remember me')}} <span class="checkmark fcheckbox"></span>
            </label>
            <a href="{{ route("password.request") }}">{{__('Forgot Password?')}}</a>
        </div>
    </div>
    @if(setting_item("user_enable_login_recaptcha"))
        <div class="form-group">
            {{recaptcha_field($captcha_action ?? 'login')}}
        </div>
    @endif
    <div class="error message-error invalid-feedback"></div>
    <div class="form-group">
        <button class="btn btn-primary form-submit" type="submit">
            {{ __('Login') }}
            <span class="spinner-grow spinner-grow-sm icon-loading" role="status" aria-hidden="true"></span>
        </button>
    </div>
    @if(is_enable_registration())
        <div class="c-grey font-medium f14 text-center"> {{__('Do not have an account?')}} <a href="" data-target="#register" data-toggle="modal">{{__('Sign Up')}}</a></div>
    @endif
    <div class="c-grey f14 text-center" style="margin-top: 15px;">
        <label>
            {{" Or "}}
        </label>
    </div>
    @if(setting_item('facebook_enable') or setting_item('google_enable') or setting_item('twitter_enable') or setting_item('kakao_enable'))
        <div class="advanced" style="margin-top:0px; padding:20px; background:none;">
            <div class="row">
                @if(setting_item('facebook_enable'))
                    <div class="col-xs-3 col-sm-3" style="width:25%;">
                    </div>
                    <div class="col-xs-2 col-sm-2" style="width:16.666%;">
                        <a href="{{url('/social-login/facebook')}}"class="btn btn_login_fb_link" data-channel="facebook" style="border-radius:50px; height: 48px; padding: 12px 0px 0px 0px;">
                            <i class="input-icon fa fa-facebook" style="font-size: 25px;"></i>
                        </a>
                    </div>
                @endif
                @if(setting_item('google_enable'))
                    <div class="col-xs-2 col-sm-2" style="width:16.666%">
                        <a href="{{url('social-login/google')}}" class="btn btn_login_gg_link" data-channel="google" style="border-radius:50px; height: 48px; padding: 12px 0px 0px 0px;">
                            <i class="input-icon fa fa-google" style="font-size: 25px;"></i>
                        </a>
                    </div>
                @endif
                @if(setting_item('kakao_enable'))
                    <div class="col-xs-2 col-sm-2" style="width:16.666%">
                        <a href="{{url('social-login/kakao')}}" class="btn btn_login_kt_link" data-channel="kakao" style="border-radius:50px; height: 48px; padding: 12px 0px 0px 0px;">
                            <i class="input-icon fa fa-comment" style="font-size: 25px;"></i>
                        </a>
                    </div>
                    <div class="col-xs-3 col-sm-3" style="width:25%;">
                    </div>
                @endif
            </div>
        </div>
    @endif
</form>
