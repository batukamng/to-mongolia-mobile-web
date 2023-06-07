<form action="{{ route("car.search") }}" class="form bravo_form" method="get" style="border-radius:5px;">
    <div class="g-field-search">
        <div class="row">
            @php $car_search_fields = setting_item_array('car_search_fields');
            $car_search_fields = array_values(\Illuminate\Support\Arr::sort($car_search_fields, function ($value) {
                return $value['position'] ?? 0;
            }));
            @endphp
            @if(!empty($car_search_fields))
                @foreach($car_search_fields as $field)
                    @php $field['title'] = $field['title_'.app()->getLocale()] ?? $field['title'] ?? "" @endphp
                    <div class="col-md-{{ $field['size'] ?? "6" }} ">
                        @switch($field['field'])
                            @case ('service_name')
                                @include('Car::frontend.layouts.search.fields.service_name')
                            @break
                            @case ('location')
                                @include('Car::frontend.layouts.search.fields.location')
                            @break
                            @case ('date')
                                @include('Car::frontend.layouts.search.fields.date')
                            @break
                            @case ('attr')
                                @include('Car::frontend.layouts.search.fields.attr')
                            @break
                        @endswitch
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="g-button-submit" style="padding-top: 20px; padding-bottom: 20px; padding-right: 10px;">
        <button class="btn btn-primary btn-search" style="border-radius:15px; margin-top:19px; height:70%;" type="submit">{{__("Search")}}</button>
    </div>
</form>
