@extends('admin.layouts.app')

@section('content')
    <form action="{{route('tour.admin.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])}}" method="post">
        @csrf
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">{{$row->id ? __('Edit: ').$row->title : __('Add new tour')}}</h1>
                    @if($row->slug)
                        <p class="item-url-demo">{{__("Permalink")}}: {{ url(config('tour.tour_route_prefix') ) }}/<a href="#" class="open-edit-input" data-name="slug">{{$row->slug}}</a>
                        </p>
                    @endif
                </div>
                <div class="">
                    @if($row->slug)
                        <a class="btn btn-primary btn-sm" href="{{$row->getDetailUrl(request()->query('lang'))}}" target="_blank">{{__("View Tour")}}</a>
                    @endif
                </div>
            </div>
            @include('admin.message')
            @if($row->id)
                @include('Language::admin.navigation')
            @endif
            <div class="lang-content-box">
                <div class="row">
                    <div class="col-md-9">
                        @include('Tour::admin/tour/tour-content')
                        @include('Tour::admin/tour/tour-location')
                        @include('Hotel::admin.hotel.surrounding')

                    @if(is_default_lang())
                            @include('Tour::admin/tour/pricing')
                            @include('Tour::admin/tour/availability')
                        @endif
                        @include('Core::admin/seo-meta/seo-meta')
                    </div>
                    <div class="col-md-3">
                        <div class="panel">
                            <div class="panel-title"><strong>{{__('Publish')}}</strong></div>
                            <div class="panel-body">
                                @if(is_default_lang())
                                    <div>
                                        <label><input @if($row->status=='publish') checked @endif type="radio" name="status" value="publish"> {{__("Publish")}}
                                        </label></div>
                                    <div>
                                        <label><input @if($row->status=='draft') checked @endif type="radio" name="status" value="draft"> {{__("Draft")}}
                                        </label></div>
                                @endif
                                <div class="text-right">
                                    <button class="btn btn-primary" type="submit">
                                        <svg class="mr-1" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.833 2.5v2.833c0 .467 0 .7.091.879.08.156.208.284.364.364.179.09.412.09.879.09h5.666c.467 0 .7 0 .879-.09a.833.833 0 0 0 .364-.364c.09-.179.09-.412.09-.879v-2m0 14.167v-5.333c0-.467 0-.7-.09-.879a.833.833 0 0 0-.364-.364c-.179-.09-.412-.09-.879-.09H7.167c-.467 0-.7 0-.879.09a.833.833 0 0 0-.364.364c-.09.179-.09.412-.09.879V17.5M17.5 7.771V13.5c0 1.4 0 2.1-.273 2.635a2.5 2.5 0 0 1-1.092 1.092c-.535.273-1.235.273-2.635.273h-7c-1.4 0-2.1 0-2.635-.273a2.5 2.5 0 0 1-1.093-1.092C2.5 15.6 2.5 14.9 2.5 13.5v-7c0-1.4 0-2.1.272-2.635a2.5 2.5 0 0 1 1.093-1.093C4.4 2.5 5.1 2.5 6.5 2.5h5.729c.407 0 .611 0 .803.046.17.04.333.108.482.2.168.103.312.247.6.535l2.605 2.605c.288.288.432.432.535.6.092.15.16.312.2.482.046.192.046.396.046.803z" stroke="#fff" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        {{__('Save Changes')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                        @if(is_default_lang())
                        <div class="panel">
                            <div class="panel-title"><strong>{{__("Author Setting")}}</strong></div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <?php
                                    $user = !empty($row->create_user) ? App\User::find($row->create_user) : false;
                                    \App\Helpers\AdminForm::select2('create_user', [
                                        'configs' => [
                                            'ajax'        => [
                                                'url' => route('user.admin.getForSelect2'),
                                                'dataType' => 'json'
                                            ],
                                            'allowClear'  => true,
                                            'placeholder' => __('-- Select User --')
                                        ]
                                    ], !empty($user->id) ? [
                                        $user->id,
                                        $user->getDisplayName() . ' (#' . $user->id . ')'
                                    ] : false)
                                    ?>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(is_default_lang())
                            <div class="panel">
                                <div class="panel-title"><strong>{{__("Tour Featured")}}</strong></div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input type="checkbox" name="is_featured" @if($row->is_featured) checked @endif value="1"> {{__("Enable featured")}}
                                    </div>
                                    <div class="form-group">
                                        <label >{{__('Default State')}}</label>
                                        <br>
                                        <select name="default_state" class="custom-select">
                                            <option value="1" @if(old('default_state',$row->default_state ?? -1) == 1) selected @endif>{{__("Always available")}}</option>
                                            <option value="0" @if(old('default_state',$row->default_state ?? -1) == 0) selected @endif>{{__("Only available on specific dates")}}</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            @include('Tour::admin/tour/attributes')
                            <div class="panel">
                                <div class="panel-title"><strong>{{__('Feature Image')}}</strong></div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        {!! \Modules\Media\Helpers\FileHelper::fieldUpload('image_id',$row->image_id) !!}
                                    </div>
                                </div>
                            </div>
                            @include('Tour::admin/tour/ical')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('js')
    {!! App\Helpers\MapEngine::scripts() !!}
    <script>
        jQuery(function ($) {
            new BravoMapEngine('map_content', {
                disableScripts: true,
                fitBounds: true,
                center: [{{$row->map_lat ?? setting_item('map_lat_default',51.505 ) }}, {{$row->map_lat ?? setting_item('map_lat_default',-0.09 ) }}],
                zoom:{{$row->map_zoom ?? "8"}},
                ready: function (engineMap) {
                    @if($row->map_lat && $row->map_lng)
                    engineMap.addMarker([{{$row->map_lat}}, {{$row->map_lng}}], {
                        icon_options: {}
                    });
                    @endif
                    engineMap.on('click', function (dataLatLng) {
                        engineMap.clearMarkers();
                        engineMap.addMarker(dataLatLng, {
                            icon_options: {}
                        });
                        $("input[name=map_lat]").attr("value", dataLatLng[0]);
                        $("input[name=map_lng]").attr("value", dataLatLng[1]);
                    });
                    engineMap.on('zoom_changed', function (zoom) {
                        $("input[name=map_zoom]").attr("value", zoom);
                    });
                    if(bookingCore.map_provider === "gmap"){
                        engineMap.searchBox($('#customPlaceAddress'),function (dataLatLng) {
                            engineMap.clearMarkers();
                            engineMap.addMarker(dataLatLng, {
                                icon_options: {}
                            });
                            $("input[name=map_lat]").attr("value", dataLatLng[0]);
                            $("input[name=map_lng]").attr("value", dataLatLng[1]);
                        });
                    }
                    engineMap.searchBox($('.bravo_searchbox'),function (dataLatLng) {
                        engineMap.clearMarkers();
                        engineMap.addMarker(dataLatLng, {
                            icon_options: {}
                        });
                        $("input[name=map_lat]").attr("value", dataLatLng[0]);
                        $("input[name=map_lng]").attr("value", dataLatLng[1]);
                    });
                }
            });
        })
    </script>
@endpush
