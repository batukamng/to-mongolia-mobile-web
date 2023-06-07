<div class="bravo_topbar">
    <div class="container">
        <div class="content">
            <div class="topbar-left">
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
            <div class="topbar-right">
                <ul class="topbar-items" style="display: inline-flex!important; margin-bottom: 0px;justify-content!important: center;align-items: center!important;">
                    
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
                        <!-- @include('Layout::parts.notification') -->
                        <li class="login-item dropdown">
                            <a href="#" data-toggle="dropdown" class="login dropdown-item-user">
                                <img src="{{Auth::user()->getAvatarUrl()}}" alt="Avatar" class="avatar mr-2">
                                <!-- {{ Auth::user()->getDisplayName() }} -->
                                <!-- <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m4 6 4 4 4-4" stroke="#344054" stroke-width="1.33" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg> -->
                            </a>
                            <ul class="dropdown-menu dropdown-menu-user text-left">
                                @if(empty( setting_item('wallet_module_disable') ))
                                    <li class="credit_amount">
                                        <a href="{{route('user.wallet')}}">
                                            <svg class="mr-2" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14.667 6.667H1.333m0-1.2v5.066c0 .747 0 1.12.146 1.406.127.25.331.454.582.582.285.146.659.146 1.406.146h9.066c.747 0 1.12 0 1.406-.146.25-.128.454-.332.582-.582.146-.286.146-.659.146-1.406V5.467c0-.747 0-1.12-.146-1.406a1.334 1.334 0 0 0-.582-.582c-.286-.146-.659-.146-1.406-.146H3.467c-.747 0-1.12 0-1.406.146-.25.127-.455.331-.582.582-.146.285-.146.659-.146 1.406z" stroke="#667085" stroke-width="1.33" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            {{__("Credit: :amount",['amount'=>auth()->user()->balance])}}
                                        </a>
                                    </li>
                                @endif
                                @if(is_admin())
                                    <li class="">
                                        <a href="{{route('admin.index')}}">
                                            <svg class="mr-2" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.6 2H3.067c-.374 0-.56 0-.703.073a.667.667 0 0 0-.291.291C2 2.507 2 2.694 2 3.067V5.6c0 .373 0 .56.073.703a.667.667 0 0 0 .291.291c.143.073.33.073.703.073H5.6c.373 0 .56 0 .703-.073a.667.667 0 0 0 .291-.291c.073-.143.073-.33.073-.703V3.067c0-.374 0-.56-.073-.703a.667.667 0 0 0-.291-.291C6.16 2 5.973 2 5.6 2zM12.933 2H10.4c-.373 0-.56 0-.703.073a.667.667 0 0 0-.291.291c-.073.143-.073.33-.073.703V5.6c0 .373 0 .56.073.703a.667.667 0 0 0 .291.291c.143.073.33.073.703.073h2.533c.374 0 .56 0 .703-.073a.667.667 0 0 0 .291-.291C14 6.16 14 5.973 14 5.6V3.067c0-.374 0-.56-.073-.703a.667.667 0 0 0-.291-.291C13.493 2 13.306 2 12.933 2zM12.933 9.333H10.4c-.373 0-.56 0-.703.073a.667.667 0 0 0-.291.291c-.073.143-.073.33-.073.703v2.533c0 .374 0 .56.073.703a.667.667 0 0 0 .291.291c.143.073.33.073.703.073h2.533c.374 0 .56 0 .703-.073a.667.667 0 0 0 .291-.291c.073-.143.073-.33.073-.703V10.4c0-.373 0-.56-.073-.703a.667.667 0 0 0-.291-.291c-.143-.073-.33-.073-.703-.073zM5.6 9.333H3.067c-.374 0-.56 0-.703.073a.667.667 0 0 0-.291.291C2 9.84 2 10.027 2 10.4v2.533c0 .374 0 .56.073.703a.667.667 0 0 0 .291.291c.143.073.33.073.703.073H5.6c.373 0 .56 0 .703-.073a.667.667 0 0 0 .291-.291c.073-.143.073-.33.073-.703V10.4c0-.373 0-.56-.073-.703a.667.667 0 0 0-.291-.291c-.143-.073-.33-.073-.703-.073z" stroke="#667085" stroke-width="1.33" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            {{__("Admin Dashboard")}}
                                        </a>
                                    </li>
                                @endif

                                @if(is_vendor())
                                <li class="">
                                    <a href="{{route('vendor.dashboard')}}" class="menu-hr">
                                        <svg class="mr-2" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2 8h12M8 2v12M5.2 2h5.6c1.12 0 1.68 0 2.108.218a2 2 0 0 1 .874.874C14 3.52 14 4.08 14 5.2v5.6c0 1.12 0 1.68-.218 2.108a2 2 0 0 1-.874.874C12.48 14 11.92 14 10.8 14H5.2c-1.12 0-1.68 0-2.108-.218a2 2 0 0 1-.874-.874C2 12.48 2 11.92 2 10.8V5.2c0-1.12 0-1.68.218-2.108a2 2 0 0 1 .874-.874C3.52 2 4.08 2 5.2 2z" stroke="#667085" stroke-width="1.33" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        {{__("Vendor Dashboard")}}
                                    </a>
                                </li>
                                @endif
                                <li class="">
                                    <a href="{{route('user.profile.index')}}">
                                        <svg class="mr-2" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.333 14c0-.93 0-1.396-.114-1.774a2.666 2.666 0 0 0-1.778-1.778c-.379-.115-.844-.115-1.774-.115H6.333c-.93 0-1.395 0-1.774.115a2.666 2.666 0 0 0-1.777 1.778c-.115.378-.115.844-.115 1.774M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" stroke="#667085" stroke-width="1.33" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        {{__("My profile")}}
                                    </a>
                                </li>
                                @if(setting_item('inbox_enable'))
                                <li class="menu-hr">
                                    <a href="{{route('user.chat')}}"><i class="fa fa-comments"></i> {{__("Messages")}}
                                        @if($count = auth()->user()->unseen_message_count)
                                            <span class="badge badge-danger">{{$count}}</span>
                                        @endif
                                    </a>
                                </li>
                                @endif
                                <li class="menu-hr">
                                    <a href="{{route('user.booking_history')}}">
                                        <svg class="mr-2" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.333 5.2c0-1.12 0-1.68.218-2.108a2 2 0 0 1 .874-.874C4.853 2 5.413 2 6.533 2h2.934c1.12 0 1.68 0 2.108.218a2 2 0 0 1 .874.874c.218.428.218.988.218 2.108V14L8 11.333 3.333 14V5.2z" stroke="#667085" stroke-width="1.33" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        {{__("Booking History")}}
                                    </a>
                                </li>
                                <!-- <li class="">
                                    <a href="{{route('user.change_password')}}">
                                        <svg class="mr-2" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.333 7.333v-2a3.333 3.333 0 1 0-6.666 0v2M5.867 14h4.266c1.12 0 1.68 0 2.108-.218a2 2 0 0 0 .874-.874c.218-.428.218-.988.218-2.108v-.267c0-1.12 0-1.68-.218-2.108a2 2 0 0 0-.874-.874c-.427-.218-.987-.218-2.108-.218H5.867c-1.12 0-1.68 0-2.108.218a2 2 0 0 0-.874.874c-.218.428-.218.988-.218 2.108v.267c0 1.12 0 1.68.218 2.108a2 2 0 0 0 .874.874c.428.218.988.218 2.108.218z" stroke="#667085" stroke-width="1.33" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        {{__("Change password")}}
                                    </a>
                                </li> -->

                                @if(is_enable_plan() )
                                    <li class="menu-hr"><a href="{{route('user.plan')}}"><i class="fa fa-list-alt"></i> {{__("My plan")}}</a></li>
                                @endif

                                <li class="menu-hr">
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-topbar').submit();">
                                        <svg class="mr-2" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4 11.333c0 .62 0 .93.068 1.185a2 2 0 0 0 1.414 1.414c.255.068.565.068 1.185.068H10.8c1.12 0 1.68 0 2.108-.218a2 2 0 0 0 .874-.874C14 12.48 14 11.92 14 10.8V5.2c0-1.12 0-1.68-.218-2.108a2 2 0 0 0-.874-.874C12.48 2 11.92 2 10.8 2H6.667c-.62 0-.93 0-1.185.068a2 2 0 0 0-1.414 1.414C4 3.737 4 4.047 4 4.667m4 .666L10.667 8m0 0L8 10.667M10.667 8H2" stroke="#667085" stroke-width="1.33" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        {{__('Logout')}}
                                    </a>
                                </li>
                            </ul>
                            <form id="logout-form-topbar" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                        <li>
                            <a class="btn btn-light commuintu-button" style="background-color:#088ab2; color:white; border-radius:5px; margin-left:5px; display:none;" href="/user/community/create">{{__("동행 찾기")}}</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
