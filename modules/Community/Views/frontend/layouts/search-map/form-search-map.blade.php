<form action="{{url( app_get_locale(false,false,'/').config('community.community_route_prefix') )}}" class="form bravo_form d-flex justify-content-start" method="get" onsubmit="return false;">

    @php $community_map_search_fields = setting_item_array('community_map_search_fields');

    $community_map_search_fields = array_values(\Illuminate\Support\Arr::sort($community_map_search_fields, function ($value) {
        return $value['position'] ?? 0;
    }));

    @endphp
    @if(!empty($community_map_search_fields))
        @foreach($community_map_search_fields as $field)
            @switch($field['field'])
                @case ('location')
                    @include('Community::frontend.layouts.search-map.fields.location')
                @break
                @case ('category')
                    @include('Community::frontend.layouts.search-map.fields.category')
                @break
                @case ('attr')
                    @include('Community::frontend.layouts.search-map.fields.attr')
                @break
                @case ('date')
                    @include('Community::frontend.layouts.search-map.fields.date')
                @break
                @case ('price')
                    @include('Community::frontend.layouts.search-map.fields.price')
                @break
                    @case ('advance')
                    <div class="filter-item filter-simple">
                        <div class="form-group">
                            <span class="filter-title toggle-advance-filter" data-target="#advance_filters">{{__('More filters')}} <i class="fa fa-angle-down"></i></span>
                        </div>
                    </div>
                @break
            @endswitch
        @endforeach
    @endif
</form>
