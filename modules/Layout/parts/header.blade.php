<div class="bravo_header">
    <div class="{{$container_class ?? 'container'}}">
        <div class="content">
            <div class="header-left" style="width:100%;">
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
                <div class="bravo-menu" style="width:100%;">
                    <?php generate_menu('primary') ?>
                </div>
            </div>
            <div class="header-right">
                @if(!empty($header_right_menu))
                    <ul class="topbar-items">
                        @include('Core::frontend.currency-switcher')
                        @include('Language::frontend.switcher')
                        @if(!Auth::check())
                            <li class="login-item">
                                <a href="#login" data-toggle="modal" data-target="#login" class="login">{{__('Login')}}</a>
                            </li>
                            @if(is_enable_registration())
                                <li class="signup-item">
                                    <a href="#register" data-toggle="modal" data-target="#register" class="signup">{{__('Sign Up')}}</a>
                                </li>
                            @endif
                        @else
                            <li class="login-item dropdown">
                                <a href="#" data-toggle="dropdown" class="is_login">
                                    @if($avatar_url = Auth::user()->getAvatarUrl())
                                        <img class="avatar" src="{{$avatar_url}}" alt="{{ Auth::user()->getDisplayName()}}">
                                    @else
                                        <span class="avatar-text">{{ucfirst( Auth::user()->getDisplayName()[0])}}</span>
                                    @endif
                                    {{__("Hi, :Name",['name'=>Auth::user()->getDisplayName()])}}
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu text-left">

                                    @if(Auth::user()->hasPermissionTo('dashboard_vendor_access'))
                                        <li><a href="{{route('vendor.dashboard')}}"><i class="icon ion-md-analytics"></i> {{__("Vendor Dashboard")}}</a></li>
                                    @endif
                                    <li class="@if(Auth::user()->hasPermissionTo('dashboard_vendor_access')) menu-hr @endif">
                                        <a href="{{route('user.profile.index')}}"><i class="icon ion-md-construct"></i> {{__("My profile")}}</a>
                                    </li>
                                    @if(setting_item('inbox_enable'))
                                    <li class="menu-hr"><a href="{{route('user.chat')}}"><i class="fa fa-comments"></i> {{__("Messages")}}</a></li>
                                    @endif
                                    <li class="menu-hr"><a href="{{route('user.booking_history')}}"><i class="fa fa-clock-o"></i> {{__("Booking History")}}</a></li>
                                    <li class="menu-hr"><a href="{{route('user.change_password')}}"><i class="fa fa-lock"></i> {{__("Change password")}}</a></li>
                                    @if(Auth::user()->hasPermissionTo('dashboard_access'))
                                        <li class="menu-hr"><a href="{{route('admin.index')}}"><i class="icon ion-ios-ribbon"></i> {{__("Admin Dashboard")}}</a></li>
                                    @endif
                                    <li class="menu-hr">
                                        <a  href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> {{__('Logout')}}</a>
                                    </li>
                                </ul>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @endif
                    </ul>
                @endif
                <button class="bravo-more-menu">
                    <svg width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 12h18M3 6h18M3 18h18" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>                    
                </button>
            </div>
        </div>
    </div>
    <div class="bravo-menu-mobile">
        <div class="user-profile">
            <div class="b-close"><i class="icofont-scroll-left"></i></div>
            <div class="avatar"></div>
            <ul class="list-group">
                @if(!Auth::check())
                    <li class="list-group-item" style="padding:0px;">
                        <button href="#login" style="width:100%; border:solid 1px gray; border-radius:10px;" type="button" data-toggle="modal" data-target="#login" class="login btn">{{__('Login')}}</button>
                    </li>
                    @if(is_enable_registration())
                        <li class="list-group-item" style="padding:0px;">
                            <button href="#register" style="width:100%; border:solid 1px green; border-radius:10px;" type="button" data-toggle="modal" data-target="#register" class="signup btn btn-outline-green">{{__('Sign Up')}}</button>
                        </li>
                    @endif
                @else
                    <!-- <li class="list-group-item">
                        <a href="{{route('user.profile.index')}}">
                            <i class="icofont-user-suited"></i> {{__("Hi, :Name",['name'=>Auth::user()->getDisplayName()])}}
                        </a>
                    </li> -->
                    @if(Auth::user()->hasPermissionTo('dashboard_vendor_access'))
                        <li class="list-group-item"><a href="{{route('vendor.dashboard')}}"><i class="icon ion-md-analytics"></i> {{__("Vendor Dashboard")}}</a></li>
                    @endif
                    <!-- @if(Auth::user()->hasPermissionTo('dashboard_access'))
                        <li class="list-group-item">
                            <a href="{{route('admin.index')}}"><i class="icon ion-ios-ribbon"></i> {{__("Admin Dashboard")}}</a>
                        </li>
                    @endif -->
                    <li class="list-group-item">
                        <a href="{{route('user.profile.index')}}">
                            <i class="icon ion-md-construct"></i> {{Auth::user()->getDisplayName()}}
                        </a>
                    </li>

                @endif
            </ul>
        </div>
        <div class="user-profile" style="">
            <ul>
                <li class="list-group-item">
                    <a href="" ><i class="icon ion-md-airplane"></i>
                    My trips</a>
                </li>
                <li class="list-group-item">
                    <a href="/user/wishlist"><i class="icon ion-md-heart"></i>
                    Wishlist
                    </a>
                </li>
                <li class="list-group-item">
                    <a href=""><i class="icon ion-md-globe"></i>
                    Travel club</a>
                </li>
                <li class="list-group-item">
                    <a href="/notify/notifications" ><i class="icon ion-md-chatboxes"></i>Conversation</a>
                </li>
                <li class="list-group-item">
                    <a href="/notify/notifications" ><i class="icon ion-md-notifications"></i>Notice</a>
                </li>
                <li class="list-group-item">
                    <a href="/page/contact-us" ><i class="icon ion-md-people"></i>Customer center</a>
                </li>
            </ul>
        </div>
        <div class="user-profile" style="bottom:0px;">
            <ul class="d-flex justify-content-around">
                @include('Core::frontend.currency-switcher')
                @include('Language::frontend.switcher')
            </ul>
            <ul class="">
                <li class="list-group-item">
                    <a  href="#" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                        <i class="fa fa-sign-out"></i> {{__('Logout')}}
                    </a>
                    <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
