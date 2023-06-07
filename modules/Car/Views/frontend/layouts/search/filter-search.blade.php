<div class="bravo_filter" style="border-color:white; margin-bottom:0px!important;">
    <form action="{{url(app_get_locale(false,false,'/').config('car.car_route_prefix'))}}" class="bravo_form_filter">
        @if( !empty(Request::query('location_id')) )
            <input type="hidden" name="location_id" value="{{Request::query('location_id')}}">
        @endif
        @if( !empty(Request::query('map_place')) )
            <input type="hidden" name="map_place" value="{{Request::query('map_place')}}">
        @endif
        @if( !empty(Request::query('map_lat')) )
            <input type="hidden" name="map_lat" value="{{Request::query('map_lat')}}">
        @endif
        @if( !empty(Request::query('map_lgn')) )
            <input type="hidden" name="map_lgn" value="{{Request::query('map_lgn')}}">
        @endif
        @if( !empty(Request::query('start')) and !empty(Request::query('end')) )
            <input type="hidden" value="{{Request::query('start',date("d/m/Y",strtotime("today")))}}" name="start">
            <input type="hidden" value="{{Request::query('end',date("d/m/Y",strtotime("+1 day")))}}" name="end">
            <input type="hidden" name="date" value="{{Request::query('date')}}">
        @endif
        @php
            $selected = (array) Request::query('terms');
            $k=1;
        @endphp
        @foreach ($attributes as $item)
            @if(empty($item['hide_in_filter_search']))
                @php
                    $translate = $item->translateOrOrigin(app()->getLocale());
                @endphp
                    @if($item->name=='Type')
                    <div class="g-filter-item" style="padding:0px!important;">
                        <div class="item-content" style="margin-top:0px; display:block!important;">
                            <ul class="nav nav-tabs" id="myTab" role="tablist" style="border:none; justify-content: center; margin-top:20px; margin-bottom:20px;">
                                @foreach($item->terms as $key => $term)
                                    @php $translate = $term->translateOrOrigin(app()->getLocale()); @endphp
                                    <li class="nav-item" style="text-align: center;" >
                                        <div class="bravo-checkbox" style="margin-bottom:0px;">
                                        <label>
                                                @if($translate->name=='Airport')
                                                    <a style="text-align:center; color:black;" {{ $term->status ? 'checked' : '' }} type="checkbox" name="terms[]" value="{{$term->id}}">
                                                    <img data-toggle="tooltip"  data-placement="top" src="{{asset('icon/airport.svg')}}"></a>
                                                    <a style="text-align:center; color:black;" @if(in_array($term->id,$selected)) @endif type="checkbox" name="terms[]" value="{{$term->id}}" 
                                                    class="nav-link" role="tab" aria-controls="guide" aria-selected="true">{!! $translate->name !!}</a>
                                                <input style="" id="51" @if(in_array($term->id,$selected)) @endif type="checkbox"  name="terms[]" value="{{$term->id}}">
                                                <span style="display:none;"  class="checkmark"></span>
                                                @endif
                                                @if($translate->name=='Taxi')
                                                    <a style="text-align:center; color:black;" @if(in_array($term->id,$selected)) @endif type="checkbox" name="terms[]" value="{{$term->id}}">
                                                    <img data-toggle="tooltip"  data-placement="top" src="{{asset('icon/taxi.svg')}}"></a>
                                                    <a style="text-align:center; color:black;" @if(in_array($term->id,$selected)) @endif type="checkbox" name="terms[]" value="{{$term->id}}" 
                                                    class="nav-link" role="tab" aria-controls="guide" aria-selected="true">{!! $translate->name !!}</a>
                                                <input style="" id="52" @if(in_array($term->id,$selected)) @endif type="checkbox" id="{{$term->id}}" name="terms[]" value="{{$term->id}}">
                                                <span style="display:none;"  class="checkmark"></span>
                                                @endif
                                                @if($translate->name=='Rent')
                                                    <a style="text-align:center; color:black;" @if(in_array($term->id,$selected)) @endif type="checkbox" name="terms[]" value="{{$term->id}}">
                                                    <img data-toggle="tooltip"  data-placement="top" src="{{asset('icon/rentcar.svg')}}"></a>
                                                    <a style="text-align:center; color:black;" @if(in_array($term->id,$selected)) @endif type="checkbox" name="terms[]" value="{{$term->id}}" 
                                                    class="nav-link" role="tab" aria-controls="guide" aria-selected="true">{!! $translate->name !!}</a>
                                                <input style="" id="53" @if(in_array($term->id,$selected)) @endif type="checkbox" id="{{$term->id}}" name="terms[]" value="{{$term->id}}">
                                                <span style="display:none;"  class="checkmark"></span>
                                                @endif
                                            </label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                    <div class="g-filter-item hidemodal" style="padding:0px!important; border:none;">
                            <div class="container">
                                <div class="row">
                                @if($item->name=='Category' && in_array('51', $selected))
                                    <div class="col-md-6" id="carCategory">
                                        <h3>Transportations</h3>
                                    </div>
                                    <div class="col-md-6" id="carCategory">
                                        <div class="dropdown" style="float:right;">
                                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:100%;">Category</button>
                                            <div class="dropdown-menu">
                                                @foreach($item->terms as $key => $term)
                                                    @php $translate = $term->translateOrOrigin(app()->getLocale()); @endphp
                                                        <label class="bravo-checkbox dropdown-item" aria-labelledby="dropdownMenuButton" >
                                                            <input @if(in_array($term->id,$selected)) checked @endif type="checkbox" name="terms[]" value="{{$term->id}}">{!! $translate->name !!}
                                                        </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @elseif($item->name=='Taxi' && in_array('52', $selected))
                                    <div class="col-md-6" id="carTaxi">
                                        <h3>Language</h3>
                                    </div>
                                    <div class="col-md-6" id="carTaxi">
                                        <div class="dropdown" id="carTaxi" style="float:right;">
                                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:100%;">Category</button>
                                            <div class="dropdown-menu">
                                                @foreach($item->terms as $key => $term)
                                                    @php $translate = $term->translateOrOrigin(app()->getLocale()); @endphp
                                                        <label class="bravo-checkbox dropdown-item" aria-labelledby="dropdownMenuButton" >
                                                            <input @if(in_array($term->id,$selected)) checked @endif type="checkbox" name="terms[]" value="{{$term->id}}">{!! $translate->name !!}
                                                        </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @elseif($item->name=='Rent' && in_array('53', $selected))
                                    <div class="col-md-6" id="carRent">
                                        <h3>Duration</h3>
                                    </div>
                                    <div class="col-md-6" id="carRent">
                                        <div class="dropdown" style="float:right;">
                                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:100%;">Category</button>
                                            <div class="dropdown-menu">
                                                @foreach($item->terms as $key => $term)
                                                    @php $translate = $term->translateOrOrigin(app()->getLocale()); @endphp
                                                        <label class="bravo-checkbox dropdown-item" aria-labelledby="dropdownMenuButton" >
                                                            <input @if(in_array($term->id,$selected)) checked @endif type="checkbox" name="terms[]" value="{{$term->id}}">{!! $translate->name !!}
                                                        </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                </div>    
                            </div>    
                    </div>
                    <div class="g-filter-item showmodal">
                        <div class="item-title" data-toggle="modal" data-target="#modal{{$k}}">
                        @if($item->name=='Category')
                            <h3> {{$item->name}} </h3>
                            <i class="fa fa-angle-up" aria-hidden="false"></i>
                            <div class="modal fade" id="modal{{$k}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                <div class="modal-dialog " style="margin:0px;">  
                                    <div class="modal-content" style="padding:25px;">
                                        <ul>
                                            @foreach($item->terms as $key => $term)
                                                @php $translate = $term->translateOrOrigin(app()->getLocale()); @endphp
                                                <li>
                                                    <div class="bravo-checkbox">
                                                        <label>
                                                            <input @if(in_array($term->id,$selected)) checked @endif type="checkbox" name="terms[]" value="{{$term->id}}"> {!! $translate->name !!}
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @elseif($item->name=='Taxi')
                            <h3> {{$item->name}} </h3>
                            <i class="fa fa-angle-up" aria-hidden="false"></i>
                            <div class="modal fade" id="modal{{$k}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                <div class="modal-dialog " style="margin:0px;">  
                                    <div class="modal-content" style="padding:25px;">
                                        <ul>
                                            @foreach($item->terms as $key => $term)
                                                @php $translate = $term->translateOrOrigin(app()->getLocale()); @endphp
                                                <li>
                                                    <div class="bravo-checkbox">
                                                        <label>
                                                            <input @if(in_array($term->id,$selected)) checked @endif type="checkbox" name="terms[]" value="{{$term->id}}"> {!! $translate->name !!}
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @elseif($item->name=='Rent')
                            <h3> {{$item->name}} </h3>
                            <i class="fa fa-angle-up" aria-hidden="false"></i>
                            <div class="modal fade" id="modal{{$k}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                <div class="modal-dialog " style="margin:0px;">  
                                    <div class="modal-content" style="padding:25px;">
                                        <ul>
                                            @foreach($item->terms as $key => $term)
                                                @php $translate = $term->translateOrOrigin(app()->getLocale()); @endphp
                                                <li>
                                                    <div class="bravo-checkbox">
                                                        <label>
                                                            <input @if(in_array($term->id,$selected)) checked @endif type="checkbox" name="terms[]" value="{{$term->id}}"> {!! $translate->name !!}
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="item-content"></div>
                        @php
                            $k=1+$k;
                        @endphp
                    </div>
                    
            @endif
        @endforeach
    </form>
</div>
