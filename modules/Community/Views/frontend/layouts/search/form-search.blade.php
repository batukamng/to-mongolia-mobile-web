<form action="{{ route("community.search") }}" class="form bravo_form com_search" method="get" style="box-shadow:none; padding-right:5px; border-radius:0px;">
    <div class="g-field-search" style="overflow:hidden; max-width:50%!important;">
        <div class="row">
            @php $community_search_fields = setting_item_array('community_search_fields');
            $community_search_fields = array_values(\Illuminate\Support\Arr::sort($community_search_fields, function ($value) {
                return $value['position'] ?? 0;
            }));
            @endphp
            @if(!empty($community_search_fields))
                @foreach($community_search_fields as $field)
                    @php $field['title'] = $field['title_'.app()->getLocale()] ?? $field['title'] ?? "" @endphp
                    @if($field['field']=='date')
                        <div class="col-md-12" style="border-radius: 999px;background-color: #f2f4f7;height: 41px;">
                            @switch($field['field'])
                                @case ('date')
                                    @include('Community::frontend.layouts.search.fields.date')
                                @break
                            @endswitch
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
    <div class="g-button-submit" style="max-width:50%;">
        <button class="btn btn-primary btn-search" style="border-radius:15px; height:100%; margin-top:0px; background-color:#088ab2;" type="submit">{{__("Search")}}</button>
    </div>
</form>