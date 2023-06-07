<div class="container bravo-top-features-container">
    <div class="bravo-top-features style-icon">
        <div class="top-features-grid">
            @foreach($list_item as $k=>$item)
                <a href="{{ $item['link'] }}" class="feature-icon-button {{ url($item['link']) == url()->current() ? 'active' : '' }}">
                    @if ($item['icon'])
                        <div class="feature-icon">{!! $item['icon'] !!}</div>
                    @endif
                    <span>{{ $item['title'] }}</span>
                </a>
            @endforeach
        </div>
    </div>
</div>