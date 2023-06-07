<?php
if(!auth()->check()) return;
[$notifications,$countUnread] = getNotify();
?>

<li class="dropdown-notifications dropdown p-0">
    <a href="#" data-toggle="dropdown" class="is_login">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M9.355 21c.705.622 1.631 1 2.646 1 1.014 0 1.94-.378 2.646-1M18 8A6 6 0 0 0 6 8c0 3.09-.78 5.206-1.65 6.605-.735 1.18-1.102 1.771-1.089 1.936.015.182.054.252.2.36.133.099.731.099 1.928.099h13.222c1.196 0 1.794 0 1.927-.098.147-.11.185-.179.2-.361.014-.165-.353-.755-1.088-1.936-.87-1.399-1.65-3.515-1.65-6.605z" stroke="#667085" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
        @if ($countUnread > 0)
        <span class="badge badge-danger notification-icon">{{$countUnread}}</span>
        @endif
    </a>
    <ul class="dropdown-menu overflow-auto notify-items dropdown-container dropdown-menu-right dropdown-large">
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
                        <a class="{{$class}} p-0" data-id="{{$idNotification}}" href="{{$link}}">
                            <div class="media">
                                <div class="media-left mr-3">
                                    <div class="media-object">
                                        @if($avatar)
                                            <img class="image-responsive" src="{{$avatar}}" alt="{{$name}}">
                                        @else
                                            <span class="avatar-text">{{ucfirst($name[0])}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="media-body">
                                    {!! $title !!}
                                    <div class="notification-meta">
                                        <small class="timestamp">{{format_interval($oneNotification->created_at)}}</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            @endif
        </ul>
        <div class="dropdown-footer text-center">
            <a href="{{route('core.notification.loadNotify')}}">{{__('View More')}}</a>
        </div>
    </ul>
</li>
