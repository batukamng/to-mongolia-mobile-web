<div class="item">
    @php
        $param = request()->input();
        $orderby =  request()->input("orderby");
    @endphp
    <!-- <div class="item-title">
        {{ __("Sort by:") }}
    </div> -->
    <div class="bravo-sub-features-tab justify-content-center">
            @php $param['orderby'] = "" @endphp
            <a class="feature-tab-button" href="{{ route("community.search",$param) }}">{{ __("모집 중인 순") }}</a>
            @php $param['orderby'] = "rate_high_low" @endphp
            <a class="feature-tab-button" href="{{ route("community.search",$param) }}">{{ __("인기순") }}</a>
            @php $param['orderby'] = "created_at" @endphp
            <a class="feature-tab-button" href="{{ route("community.search",$param) }}">{{ __("최신 순") }}</a>
    </div>
</div>
<div class="item">
    @include('Community::frontend.layouts.search.form-search')
</div>
<style>
    .commuintu-button {
        display:block!important;
    }
</style>