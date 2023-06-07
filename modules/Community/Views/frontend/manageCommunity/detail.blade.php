@extends('layouts.user')
@section('content')
    <h2 class="title-bar no-border-bottom">
        {{$row->id ? __('Edit: ').$row->title : __('Add new community')}}
    </h2>
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{!! clean($message) !!}</strong>
        </div>
        <div classs="container p-5">
            <div class="row no-gutters comm-alert fixed-bottom">
                <div class="col-lg-5 col-md-12 ml-auto">
                    <div class="alert alert-gradient shadow" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="True" style="color:#fff">&times;</span>
                        </button>
                        <h4 class="alert-heading-gradient"><strong>{!! clean($message) !!}</strong></h4>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if($row->id)
        @include('Language::admin.navigation')
    @endif
    <div class="lang-content-box">
        <form action="{{route('community.vendor.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])}}" method="post">
            @csrf
            <div class="form-add-service">
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a data-toggle="tab" href="#nav-community-content" aria-selected="true" class="active">{{__("1. Content")}}</a>
                    <!-- <a data-toggle="tab" href="#nav-community-location" aria-selected="false">{{__("2. Locations")}}</a> -->
                    @if(is_default_lang())
                        <!-- <a data-toggle="tab" href="#nav-community-pricing" aria-selected="false">{{__("3. Pricing")}}</a>
                        <a data-toggle="tab" href="#nav-availability" aria-selected="false">{{__("4. Availability")}}</a> -->
                        <!-- <a data-toggle="tab" href="#nav-attribute" aria-selected="false">{{__("5. Attributes")}}</a>
                        <a data-toggle="tab" href="#nav-ical" aria-selected="false">{{__("6. Ical")}}</a> -->
                    @endif
                </div>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-community-content">
                    <div class="panel">
                        <div class="panel-title"><strong>{{__("Community Content")}}</strong></div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>{{__("Title")}}</label>
                                <input type="text" value="{!! clean($translation->title) !!}" placeholder="{{__("Community title")}}" name="title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{__("Content")}}</label>
                                <div class="">
                                    <textarea name="content" class="d-none has-ckeditor" cols="30" rows="10">{{$translation->content}}</textarea>
                                </div>
                            </div>
                            <div class="form-group d-none">
                                <label class="control-label">{{__("Description")}}</label>
                                <div class="">
                                    <textarea name="short_desc" class="form-control" cols="30" rows="4">{{$translation->short_desc}}</textarea>
                                </div>
                            </div>
                            @if(is_default_lang())
                                @if(is_default_lang())
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="control-label">{{__("Minimum advance reservations")}}</label>
                                                <input type="number" name="min_day_before_booking" class="form-control" value="{{$row->min_day_before_booking}}" placeholder="{{__("Ex: 3")}}">
                                                <!-- <i>{{ __("Leave blank if you dont need to use the min day option") }}</i> -->
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="control-label">{{__("Duration")}}</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="duration" class="form-control" value="{{$row->duration}}" placeholder="{{__("Duration")}}"  aria-describedby="basic-addon2">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon2">{{__('days')}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="control-label">{{__("Joined people")}}</label>
                                                <input type="text" name="min_people" class="form-control" value="{{$row->min_people}}" placeholder="{{__("Joined people")}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="control-label">{{__("Group limit")}}</label>
                                                <input type="text" name="max_people" class="form-control" value="{{$row->max_people}}" placeholder="{{__("Group limit")}}">
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            @endif
                            <?php do_action(\Modules\Community\Hook::FORM_AFTER_MAX_PEOPLE,$row) ?>
                            <div class="form-group-item">
                                <div class="g-more hide">
                                    <div class="item" data-number="__number__">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <input type="text" __name__="faqs[__number__][title]" class="form-control" placeholder="{{__('Eg: When and where does the community end?')}}">
                                            </div>
                                            <div class="col-md-6">
                                                <textarea __name__="faqs[__number__][content]" class="form-control full-h" placeholder="..."></textarea>
                                            </div>
                                            <div class="col-md-1">
                                                <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <!-- <div class="panel-title"><strong>{{__("Availability")}}</strong></div> -->
                                <div class="panel-body">

                                    <h3 class="panel-body-title">{{__('Trip date')}}</h3>
                                    <div class="form-group" hidden>
                                        <label>
                                            <input type="checkbox" name="enable_fixed_date" checked value="1"> {{__('Enable Fixed Date')}}
                                        </label>
                                    </div>
                                    <?php $old = $row->meta->open_hours ?? [];?>
                                    <div class="row" data-condition="enable_fixed_date:is(1)">
                                        <div class="col-lg-3">
                                            <div class="form-group" >
                                                <label for="">{{__("Start Date")}}</label>
                                                <input type="text" name="start_date" id=" start_date" class="form-control has-datepicker" value="{{ old('start_date',!empty($row->start_date)?$row->start_date->format("Y-m-d"):"")}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group" >
                                                <label for="">{{__("End Date")}}</label>
                                                <input type="text" name="end_date" id=" end_date"  class="form-control has-datepicker" value="{{ old('end_date',!empty($row->end_date)?$row->end_date->format("Y-m-d"):"")}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-3" hidden>
                                            <div class="form-group" >
                                                <label for="">{{__("Last Booking Date")}}</label>
                                                <input type="text" name="last_booking_date" id=" last_booking_date" class="form-control has-datepicker" value="{{ old('start_date',!empty($row->start_date)?$row->start_date->format("Y-m-d"):"")}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('Community::admin/community/attributes')
                            <!-- @include('Community::admin/community/include-exclude') -->
                            @include('Community::admin/community/itinerary')
                            @if(is_default_lang())
                                <div class="form-group" hidden>
                                    <label class="control-label">{{__("Banner Image")}}</label>
                                    <div class="form-group-image">
                                        {!! \Modules\Media\Helpers\FileHelper::fieldUpload('banner_image_id',$row->banner_image_id) !!}
                                    </div>
                                </div>
                                <div class="form-group" hidden>
                                    <label class="control-label">{{__("Gallery")}}</label>
                                    {!! \Modules\Media\Helpers\FileHelper::fieldGalleryUpload('gallery',$row->gallery) !!}
                                </div>
                            @endif
                        </div>
                    </div>
                        @if(is_default_lang())
                            <div class="form-group" >
                                <label>{{__("Featured Image")}}</label>
                                {!! \Modules\Media\Helpers\FileHelper::fieldUpload('image_id',$row->image_id) !!}
                            </div>
                        @endif
                    </div>
                    @if(is_default_lang())
                        <div class="tab-pane fade" id="nav-community-pricing">
                            <div class="panel">
                                <div class="panel-title"><strong>{{__('Default State')}}</strong></div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select name="default_state" class="custom-select">
                                                    <option value="">{{__('-- Please select --')}}</option>
                                                    <option value="1" @if(old('default_state',$row->default_state ?? 0) == 1) selected @endif>{{__("Always available")}}</option>
                                                    <option value="0" @if(old('default_state',$row->default_state ?? 0) == 0) selected @endif>{{__("Only available on specific dates")}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <button class="btn btn-primary" type="submit">
                    <svg class="mr-1" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.833 2.5v2.833c0 .467 0 .7.091.879.08.156.208.284.364.364.179.09.412.09.879.09h5.666c.467 0 .7 0 .879-.09a.833.833 0 0 0 .364-.364c.09-.179.09-.412.09-.879v-2m0 14.167v-5.333c0-.467 0-.7-.09-.879a.833.833 0 0 0-.364-.364c-.179-.09-.412-.09-.879-.09H7.167c-.467 0-.7 0-.879.09a.833.833 0 0 0-.364.364c-.09.179-.09.412-.09.879V17.5M17.5 7.771V13.5c0 1.4 0 2.1-.273 2.635a2.5 2.5 0 0 1-1.092 1.092c-.535.273-1.235.273-2.635.273h-7c-1.4 0-2.1 0-2.635-.273a2.5 2.5 0 0 1-1.093-1.092C2.5 15.6 2.5 14.9 2.5 13.5v-7c0-1.4 0-2.1.272-2.635a2.5 2.5 0 0 1 1.093-1.093C4.4 2.5 5.1 2.5 6.5 2.5h5.729c.407 0 .611 0 .803.046.17.04.333.108.482.2.168.103.312.247.6.535l2.605 2.605c.288.288.432.432.535.6.092.15.16.312.2.482.046.192.046.396.046.803z" stroke="#fff" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    {{__('Save Changes')}}
                </button>
            </div>
        </form>
    </div>
@endsection
@push('js')
    <script type="text/javascript" src="{{ asset('libs/tinymce/js/tinymce/tinymce.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('js/condition.js?_ver='.config('app.asset_version')) }}"></script>
    {!! App\Helpers\MapEngine::scripts() !!}
    <script>
        jQuery(function ($) {
            $('.has-datepicker').daterangepicker({
                singleDatePicker: true,
                showCalendar: false,
                autoUpdateInput: false, //disable default date
                sameDate: true,
                autoApply           : true,
                disabledPast        : true,
                enableLoading       : true,
                showEventTooltip    : true,
                classNotAvailable   : ['disabled', 'off'],
                disableHightLight: true,
                locale:{
                    format:'YYYY/MM/DD'
                }
            }).on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('YYYY/MM/DD'));
            });

            new BravoMapEngine('map_content', {
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
