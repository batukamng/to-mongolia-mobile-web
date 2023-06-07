<?php
[$notifications,$countUnread] = getNotify();

?>
@if(!empty($breadcrumbs))
<div class="breadcrumb-page-bar" aria-label="breadcrumb">
    <ul class="page-breadcrumb">
        @include('Language::frontend.switcher')
    </ul>
    <ul class="page-breadcrumb">
        <li class="">
            <a href="{{url('/')}}" class="mr-2">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.667 14.167h6.666M9.181 2.303 3.53 6.7c-.377.294-.566.441-.702.625-.12.163-.21.347-.265.542-.062.22-.062.46-.062.938v6.03c0 .933 0 1.4.182 1.756.16.314.414.569.728.729.357.181.823.181 1.757.181h9.666c.934 0 1.4 0 1.757-.181.314-.16.569-.415.728-.729.182-.356.182-.823.182-1.757V8.804c0-.478 0-.718-.062-.938a1.665 1.665 0 0 0-.265-.542c-.136-.184-.325-.33-.702-.625l-5.652-4.396c-.293-.227-.44-.341-.601-.385a.834.834 0 0 0-.436 0c-.161.044-.308.158-.6.385z" stroke="#667085" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
            <svg class="mr-2" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="m6 12 4-4-4-4" stroke="#D0D5DD" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </li>
        @foreach($breadcrumbs as $breadcrumb)
            <li class=" {{$breadcrumb['class'] ?? ''}}">
                @if(!empty($breadcrumb['url']))
                    <a href="{{ $breadcrumb['url'] }}" class="mr-2">
                        <span>{{$breadcrumb['name']}}</span>
                    </a>
                    <svg class="mr-2" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="m6 12 4-4-4-4" stroke="#D0D5DD" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                @else
                    <span>{{$breadcrumb['name']}}</span>
                @endif
            </li>
        @endforeach
    </ul>
    <div class="dropdown dropdown-notifications float-right" style="min-width: 0">
        <a data-toggle="dropdown" class="user-dropdown d-flex align-items-center" aria-haspopup="true" aria-expanded="false">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.794 17.5a3.32 3.32 0 0 0 2.205.833 3.32 3.32 0 0 0 2.205-.833M15 6.666a5 5 0 0 0-10 0c0 2.576-.65 4.339-1.375 5.505-.612.984-.918 1.476-.907 1.613.013.152.045.21.167.3.11.082.61.082 1.606.082h11.019c.997 0 1.495 0 1.605-.082.123-.09.155-.148.168-.3.01-.137-.295-.63-.907-1.613-.726-1.166-1.376-2.93-1.376-5.504z" stroke="#667085" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span class="badge badge-danger notification-icon">{{$countUnread}}</span>
        </a>
        <div class="dropdown-menu overflow-auto notify-items dropdown-container dropdown-menu-right dropdown-large" aria-labelledby="dropdownMenuButton">
            <div class="dropdown-toolbar">
                <div class="dropdown-toolbar-actions">
                    <a href="#" class="markAllAsRead">{{__('Mark all as read')}}</a>
                </div>
                <h3 class="dropdown-toolbar-title">{{__('Notifications')}} (<span class="notif-count">{{$countUnread}}</span>)</h3>
            </div>
            <ul class="dropdown-list-items p-0">
                @if(count($notifications)> 0)
                    @foreach($notifications as $oneNotification)
                        @php
                            $active = $class = '';
                            $data = json_decode($oneNotification['data']);

                            $idNotification = @$data->id;
                            $forAdmin = @$data->for_admin;
                            $usingData = @$data->notification;

                            $services = @$usingData->type;
                            $idServices = @$usingData->id;
                            $title = @$usingData->message;
                            $name = @$usingData->name;
                            $avatar = @$usingData->avatar;
                            $link = @$usingData->link;

                            if(empty($oneNotification->read_at)){
                                $class = 'markAsRead';
                                $active = 'active';
                            }

                        @endphp
                        <li class="notification {{$active}}">
                            <div class="media">
                                <div class="media-left">
                                    <div class="media-object">
                                        @if($avatar)
                                            <img class="image-responsive" src="{{$avatar}}" alt="{{$name}}">
                                        @else
                                            <span class="avatar-text">{{ucfirst($name[0])}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="media-body">
                                    <a class="{{$class}}" data-id="{{$idNotification}}" href="{{$link}}">{!! $title !!}</a>
                                    <div class="notification-meta">
                                        <small class="timestamp">{{format_interval($oneNotification->created_at)}}</small>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
            <div class="dropdown-footer text-center">
                <a href="{{route('core.notification.loadNotify')}}">{{__('View More')}}</a>
            </div>
        </div>
    </div>
    <div class="bravo-more-menu-user">
        <i class="icofont-settings"></i>
    </div>
</div>
@endif
