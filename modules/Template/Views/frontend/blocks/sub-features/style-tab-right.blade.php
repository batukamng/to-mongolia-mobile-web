<div class="container container-x-scroll text-center">
    <div class="bravo-sub-features-tab justify-content-right">
        @foreach($list_item as $k=>$item)
            <a href="{{ $item['link'] }}" class="feature-tab-button {{ url($item['link']) == url()->current() ? 'active' : '' }} {{$item['class'] ?? ''}}">
                <span>{{ $item['title'] }}</span>
            </a>
        @endforeach
    </div>
</div>