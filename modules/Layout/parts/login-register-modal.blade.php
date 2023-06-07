<div class="modal fade login" id="login" tabindex="-1" role="dialog" aria-hidden="true" style="background-color:white;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content relative" style="border:none;">
            <div class="modal-header" style="justify-content:center; margin-bottom: 100px;">
                <a href="{{url(app_get_locale(false,'/'))}}" class="bravo-logo" style="height:44px;">
                    @php
                        $logo_id = setting_item("logo_id");
                        if(!empty($row->custom_logo)){
                            $logo_id = $row->custom_logo;
                        }
                    @endphp
                    @if($logo_id)
                        <?php $logo = get_file_url($logo_id,'full') ?>
                        <img src="{{$logo}}" alt="{{setting_item("site_title")}}" style="height:70px;">
                    @endif
                </a>
            </div>
            <div class="modal-body relative">
                @include('Layout::auth/login-form')
            </div>
        </div>
    </div>
</div>
<div class="modal fade login" id="register" tabindex="-1" role="dialog" aria-hidden="true" style="background-color:white;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content relative" style="border:none;">
        <div class="modal-header" style="justify-content:center; margin-bottom: 100px;">
                <a href="{{url(app_get_locale(false,'/'))}}" class="bravo-logo" style="height:44px;">
                    @php
                        $logo_id = setting_item("logo_id");
                        if(!empty($row->custom_logo)){
                            $logo_id = $row->custom_logo;
                        }
                    @endphp
                    @if($logo_id)
                        <?php $logo = get_file_url($logo_id,'full') ?>
                        <img src="{{$logo}}" alt="{{setting_item("site_title")}}" style="height:70px;">
                    @endif
                </a>
            </div>
            <!-- <div class="modal-header">
                <h4 class="modal-title">{{__('Sign Up')}}</h4>
                <span class="c-pointer" data-dismiss="modal" aria-label="Close">
                    <i class="input-icon field-icon fa">
                        <img src="{{url('images/ico_close.svg')}}" alt="close">
                    </i>
                </span>
            </div> -->
            <div class="modal-body">
                @include('Layout::auth/register-form')
            </div>
        </div>
    </div>
</div>