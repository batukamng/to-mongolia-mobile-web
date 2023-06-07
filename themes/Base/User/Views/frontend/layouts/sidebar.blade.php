<?php
$dataUser = Auth::user();
$menus = [
    'dashboard'       => [
        'url'        => route("vendor.dashboard"),
        'title'      => __("Dashboard"),
        'icon'       => 'fa fa-home',
        'permission' => 'dashboard_vendor_access',
        'position'   => 10
    ],
    'booking-history' => [
        'url'      => route("user.booking_history"),
        'title'    => __("Booking History"),
        'icon'     => 'fa fa-clock-o',
        'position' => 20
    ],
    "wishlist"=>[
        'url'   => route("user.wishList.index"),
        'title' => __("Wishlist"),
        'icon'  => 'fa fa-heart-o',
        'position' => 21
    ],
    'profile'         => [
        'url'      => route("user.profile.index"),
        'title'    => __("My Profile"),
        'icon'     => 'fa fa-cogs',
        'position' => 120
    ],
    'password'        => [
        'url'      => route("user.change_password"),
        'title'    => __("Change password"),
        'icon'     => 'fa fa-lock',
        'position' => 130
    ],
    'admin'           => [
        'url'        => route('admin.index'),
        'title'      => __("Admin Dashboard"),
        'icon'       => 'ion-ios-ribbon',
        'permission' => 'dashboard_access',
        'position'   => 140
    ]
];

// Modules
$custom_modules = \Modules\ServiceProvider::getModules();
if(!empty($custom_modules)){
    foreach($custom_modules as $module){
        $moduleClass = "\\Modules\\".ucfirst($module)."\\ModuleProvider";
        if(class_exists($moduleClass))
        {
            $menuConfig = call_user_func([$moduleClass,'getUserMenu']);
            if(!empty($menuConfig)){
                $menus = array_merge($menus,$menuConfig);
            }
            $menuSubMenu = call_user_func([$moduleClass,'getUserSubMenu']);
            if(!empty($menuSubMenu)){
                foreach($menuSubMenu as $k=>$submenu){
                    $submenu['id'] = $submenu['id'] ?? '_'.$k;
                    if(!empty($submenu['parent']) and isset($menus[$submenu['parent']])){
                        $menus[$submenu['parent']]['children'][$submenu['id']] = $submenu;
                        $menus[$submenu['parent']]['children'] = array_values(\Illuminate\Support\Arr::sort($menus[$submenu['parent']]['children'], function ($value) {
                            return $value['position'] ?? 100;
                        }));
                    }
                }
            }
        }
    }
}

// Plugins Menu
$plugins_modules = \Plugins\ServiceProvider::getModules();
if(!empty($plugins_modules)){
    foreach($plugins_modules as $module){
        $moduleClass = "\\Plugins\\".ucfirst($module)."\\ModuleProvider";
        if(class_exists($moduleClass))
        {
            $menuConfig = call_user_func([$moduleClass,'getUserMenu']);
            if(!empty($menuConfig)){
                $menus = array_merge($menus,$menuConfig);
            }
            $menuSubMenu = call_user_func([$moduleClass,'getUserSubMenu']);
            if(!empty($menuSubMenu)){
                foreach($menuSubMenu as $k=>$submenu){
                    $submenu['id'] = $submenu['id'] ?? '_'.$k;
                    if(!empty($submenu['parent']) and isset($menus[$submenu['parent']])){
                        $menus[$submenu['parent']]['children'][$submenu['id']] = $submenu;
                        $menus[$submenu['parent']]['children'] = array_values(\Illuminate\Support\Arr::sort($menus[$submenu['parent']]['children'], function ($value) {
                            return $value['position'] ?? 100;
                        }));
                    }
                }
            }
        }
    }
}

// Custom Menu
$custom_modules = \Custom\ServiceProvider::getModules();
if(!empty($custom_modules)){
    foreach($custom_modules as $module){
        $moduleClass = "\\Custom\\".ucfirst($module)."\\ModuleProvider";
        if(class_exists($moduleClass))
        {
            $menuConfig = call_user_func([$moduleClass,'getUserMenu']);
            if(!empty($menuConfig)){
                $menus = array_merge($menus,$menuConfig);
            }
            $menuSubMenu = call_user_func([$moduleClass,'getUserSubMenu']);
            if(!empty($menuSubMenu)){
                foreach($menuSubMenu as $k=>$submenu){
                    $submenu['id'] = $submenu['id'] ?? '_'.$k;
                    if(!empty($submenu['parent']) and isset($menus[$submenu['parent']])){
                        $menus[$submenu['parent']]['children'][$submenu['id']] = $submenu;
                        $menus[$submenu['parent']]['children'] = array_values(\Illuminate\Support\Arr::sort($menus[$submenu['parent']]['children'], function ($value) {
                            return $value['position'] ?? 100;
                        }));
                    }
                }
            }
        }
    }
}

$currentUrl = url(Illuminate\Support\Facades\Route::current()->uri());
if (!empty($menus))
    $menus = array_values(\Illuminate\Support\Arr::sort($menus, function ($value) {
        return $value['position'] ?? 100;
    }));
    foreach ($menus as $k => $menuItem) {
        if (!empty($menuItem['permission']) and !Auth::user()->hasPermissionTo($menuItem['permission'])) {
            unset($menus[$k]);
            continue;
        }
        $menus[$k]['class'] = $currentUrl == url($menuItem['url']) ? 'active' : '';
        if (!empty($menuItem['children'])) {
            $menus[$k]['class'] .= ' has-children';
            foreach ($menuItem['children'] as $k2 => $menuItem2) {
                if (!empty($menuItem2['permission']) and !Auth::user()->hasPermissionTo($menuItem2['permission'])) {
                    unset($menus[$k]['children'][$k2]);
                    continue;
                }
                $menus[$k]['children'][$k2]['class'] = $currentUrl == url($menuItem2['url']) ? 'active active_child' : '';
            }
        }
    }
?>
<div class="sidebar-user">
    <div class="bravo-close-menu-user"><i class="icofont-scroll-left"></i></div>
    <div class="logo">
        @if($avatar_url = $dataUser->getAvatarUrl())
            <img src="{{$dataUser->getAvatarUrl()}}" class="avatar avatar-cover">
        @else
            <span class="avatar-text">{{ucfirst($dataUser->getDisplayName()[0])}}</span>
        @endif
    </div>
    <div class="user-profile-avatar">
        <div class="info-new">
            <span class="role-name badge badge-info">{{$dataUser->role_name}}</span>
            <h5>{{$dataUser->getDisplayName()}}</h5>
            <p>{{ __("Member Since :time",["time"=> date("M Y",strtotime($dataUser->created_at))]) }}</p>
        </div>
    </div>
    <!-- <div class="user-profile-plan">
        @if( !Auth::user()->hasPermissionTo("dashboard_vendor_access") and setting_item('vendor_enable'))
            <a href=" {{ route("user.upgrade_vendor") }}">{{ __("Become a vendor") }}</a>
        @endif
    </div> -->
    <div class="sidebar-menu">
        <ul class="main-menu">
            @foreach($menus as $menuItem)
                @if($menuItem['title']=='Manage Community')
                    <li class="{{$menuItem['class']}}" data-position="{{$menuItem['position'] ?? 100}}">
                        <a href="{{ url($menuItem['url']) }}">
                        <span class="icon text-center"><i class="fa fa-users" aria-hidden="true"></i></span>
                            {!! clean($menuItem['title']) !!}
                        </a>
                    </li>
                    <li>
                        <a href="/notify/notifications">
                        <span class="icon text-center"><i class="fa fa-bell" aria-hidden="true"></i></span>
                            {{"Notification"}}
                        </a>
                    </li>
                @else
                    <li class="{{$menuItem['class']}}" data-position="{{$menuItem['position'] ?? 100}}">
                        <a href="{{ url($menuItem['url']) }}">
                            @if(!empty($menuItem['icon']))
                                <span class="icon text-center"><i class="{{$menuItem['icon']}}"></i></span>
                            @endif
                            {!! clean($menuItem['title']) !!}
                        </a>
                        @if(!empty($menuItem['children']))
                            <i class="caret"></i>
                        @endif
                        @if(!empty($menuItem['children']))
                            <ul class="children">
                                @foreach($menuItem['children'] as $menuItem2)
                                    <li class="{{$menuItem2['class']}}"><a href="{{ url($menuItem2['url']) }}">
                                            @if(!empty($menuItem2['icon']))
                                                <i class="{{$menuItem2['icon']}}"></i>
                                            @endif
                                            {!! clean($menuItem2['title']) !!}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
    <div class="backhome">
        <a href="{{url('/')}}">
            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 12H4m0 0 6 6m-6-6 6-6" stroke="#667085" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            {{__("Back to Homepage")}}
        </a>
    </div>
    <div class="logout">
        <form id="logout-form-vendor" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-vendor').submit();">            
            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="m16 17 5-5m0 0-5-5m5 5H9m0-9H7.8c-1.68 0-2.52 0-3.162.327a3 3 0 0 0-1.311 1.311C3 5.28 3 6.12 3 7.8v8.4c0 1.68 0 2.52.327 3.162a3 3 0 0 0 1.311 1.311C5.28 21 6.12 21 7.8 21H9" stroke="#F04438" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            {{__("Log Out")}}
        </a>
    </div>
</div>
