@extends('admin.layouts.app')

@section('content')
    <form action="{{route('location.admin.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])}}" method="post">
        @csrf
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">{{$row->id ? 'Edit: '.$row->name : __("Add new location")}}</h1>
                    @if($row->slug)
                        <p class="item-url-demo">{{__("Permalink")}}: {{ url( (request()->query('lang') ? request()->query('lang').'/' : '').config('location.location_route_prefix'))  }}/<a href="#" class="open-edit-input" data-name="slug">{{$row->slug}}</a></p>
                    @endif
                </div>
                <div class="">
                    @if($row->slug)
                        <a class="btn btn-primary btn-sm" href="{{$row->getDetailUrl(request()->query('lang'))}}" target="_blank">{{__("View")}}</a>
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
                        <div class="panel">
                            <div class="panel-body">
                                <h3 class="panel-body-title">{{__("Location Content")}}</h3>
                                @include('Location::admin/form')
                                @if(is_default_lang())
                                    <div class="form-group">
                                        <label class="control-label">{{__("Banner Image")}}</label>
                                        <div class="form-group-image">
                                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('banner_image_id',$row->banner_image_id) !!}
                                        </div>
                                    </div>

                                    <div class="form-group form-index-hide">
                                        <label class="control-label">{{__("The geographic coordinate")}}</label>
                                        <div class="control-map-group">
                                            <div id="map_content"></div>
                                            <div class="g-control">
                                                <div class="form-group">
                                                    <label>{{__("Map Latitude")}}:</label>
                                                    <input type="text" name="map_lat" class="form-control" value="{{$row->map_lat}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>{{__("Map Longitude")}}:</label>
                                                    <input type="text" name="map_lng" class="form-control" value="{{$row->map_lng}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>{{__("Map Zoom")}}:</label>
                                                    <input type="text" name="map_zoom" class="form-control" value="{{$row->map_zoom ?? "8"}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group-item">
                                    <label class="control-label">{{__('Trip Ideas')}}</label>
                                    <div class="g-items-header">
                                        <div class="row">
                                            <div class="col-md-2">{{__('Image')}}</div>
                                            <div class="col-md-4">{{__("Title/Link")}}</div>
                                            <div class="col-md-5">{{__('Content')}}</div>
                                            <div class="col-md-1"></div>
                                        </div>
                                    </div>
                                    <div class="g-items">
                                        @if(!empty($translation->trip_ideas))
                                            @php if(!is_array($translation->trip_ideas)) $translation->trip_ideas = json_decode($translation->trip_ideas); @endphp
                                            @if(count($translation->trip_ideas))
                                            @foreach($translation->trip_ideas as $key=>$trip_idea)
                                                <div class="item" data-number="{{$key}}">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('trip_ideas['.$key.'][image_id]',$trip_idea['image_id']) !!}
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text" name="trip_ideas[{{$key}}][title]" class="form-control" value="{{$trip_idea['title']}}" placeholder="{{__("Title:")}}">
                                                            <input type="text" name="trip_ideas[{{$key}}][link]" class="form-control" value="{{$trip_idea['link']}}" placeholder="{{__("Link:")}}">
                                                        </div>
                                                        <div class="col-md-5">
                                                            <textarea name="trip_ideas[{{$key}}][content]" class="form-control full-h" placeholder="...">{{$trip_idea['content']}}</textarea>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @endif
                                        @endif
                                    </div>
                                    <div class="text-right">
                                        <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> {{__('Add item')}}</span>
                                    </div>
                                    <div class="g-more hide">
                                        <div class="item" data-number="__number__">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    {!! \Modules\Media\Helpers\FileHelper::fieldUpload('trip_ideas[__number__][image_id]','','__name__') !!}
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" __name__="trip_ideas[__number__][title]" class="form-control" placeholder="{{__("Title:")}}">
                                                    <input type="text" __name__="trip_ideas[__number__][link]" class="form-control" placeholder="{{__("Link:")}}">
                                                </div>
                                                <div class="col-md-5">
                                                    <textarea __name__="trip_ideas[__number__][content]" class="form-control full-h" placeholder="..."></textarea>
                                                </div>
                                                <div class="col-md-1">
                                                    <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
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
                        <div class="panel">
                            <div class="panel-title"><strong>{{__('Category')}}</strong></div>
                            <div class="panel-body">
                                @if(is_default_lang())
                                    <div class="form-group">
                                        <select name="category_id" class="form-control">
                                            <option value="">{{__("-- Please Select --")}}</option>
                                            @foreach($categories as $category)
                                                <option @if($row->category_id == $category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
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
                                <div class="panel-title"><strong>{{__('Feature Image')}}</strong></div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        {!! \Modules\Media\Helpers\FileHelper::fieldUpload('image_id',$row->image_id) !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('js')
    {!! \App\Helpers\MapEngine::scripts() !!}
    <script>
        jQuery(function ($) {
            new BravoMapEngine('map_content', {
                disableScripts:true,
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
                    })
                }
            });
        })
    </script>
@endpush
