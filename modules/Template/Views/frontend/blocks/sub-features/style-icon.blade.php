<div class="container container-x-scroll text-center">
    <div class="bravo-sub-features">
        @foreach($list_item as $k=>$item)
            <a href="{{ $item['link'] }}" class="feature-icon-button {{ url($item['link']) == url()->current() ? 'active' : '' }} {{$item['class'] ?? ''}}">
                @if ($item['icon'])
                    <div class="feature-icon">{!! $item['icon'] !!}</div>
                @endif
                <span>{{ $item['title'] }}</span>
            </a>
        @endforeach
    </div>
</div>