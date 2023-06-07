@php
    $languages = \Modules\Language\Models\Language::getActive();
    $locale = session('website_locale',app()->getLocale());
@endphp
{{--Multi Language--}}
@if(!empty($languages) && setting_item('site_enable_multi_lang'))
    <li class="dropdown">
        @foreach($languages as $language)
            @if($locale != $language->locale)
                <a href="{{get_lang_switcher_url($language->locale)}}" data-toggle="tooltip" data-placement="bottom" title="{{$language->name}}" class="is_login" style="font-size:24px;">
                    @if($language->flag)
                    <!-- <i class="fa fa-globe" aria-hidden="true" style="font-size:22px;"></i> -->
                    <span class="icofont-globe" style="font-size:22px;"></span>
                    @endif
                    <!-- <i class="fa fa-angle-down"></i> -->
                </a>
            @endif
        @endforeach
        <!-- <ul style="list-style-type: none; padding:0px;">
            @foreach($languages as $language)
                @if($locale != $language->locale)
                    <li>
                        <a href="{{get_lang_switcher_url($language->locale)}}" class="is_login">
                            @if($language->flag)
                                <span class="flag-icon flag-icon-{{$language->flag}}"></span>
                            @endif
                        </a>
                    </li>
                @endif
            @endforeach
        </ul> -->
    </li>
@endif
{{--End Multi language--}}