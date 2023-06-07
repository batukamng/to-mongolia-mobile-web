<div class="bravo-tip-locations">
    <div class="container">
        @if($title)
            <div class="bravo-tip-locations-title" style="font-size:28px;">
                <strong>{{$title}}</strong>
                @if(!empty($desc))
                    <div class="bravo-tip-locations-sub-title">
                        {{$desc}}
                    </div>
                @endif
            </div>
        @endif
        <div class="bravo-tip-locations-grid">
            @foreach ($rows as $item)
                <a href="{{$item->getDetailUrl()}}" class="bravo-tip-locations-item">
                    <div class="bravo-tip-locations-item-media">
                        <img src="{{$item->getImageUrl()}}" alt="{{$item->name}}">
                    </div>
                    <div class="bravo-tip-locations-item-content">
                        <h4 class="bravo-tip-locations-item-title">
                            {{$item->name}}
                        </h4>
                        <div class="bravo-tip-locations-item-action">
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.335 8.083a1.75 1.75 0 1 0 0-3.5 1.75 1.75 0 0 0 0 3.5z" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M7.335 13.333C9.668 11 12 8.911 12 6.333a4.667 4.667 0 0 0-9.333 0c0 2.578 2.333 4.667 4.667 7z" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Get address location</span>
                            <svg class="arrow" width="15" height="15" viewBox="0 0 15 15" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.248 7.5h8.167m0 0L7.33 3.417M11.415 7.5 7.33 11.583" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>