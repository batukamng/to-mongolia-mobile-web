<div class="bravo-info-image">
    <div class="container">
        <div class="bravo-info-image-wrapper {{ $style ?? 'left' }}">
            <div class="bravo-info-image-content">
                @if (!empty($label))
                    <div class="bravo-info-image-label">
                        <span>{{$label}}</span>
                    </div>
                @endif

                @if (!empty($title))
                    <div class="bravo-info-image-title">
                        <span>{{$title}}</span>
                    </div>
                @endif

                @if (!empty($desc))
                    <div class="bravo-info-image-desc">
                        <span>{{$desc}}</span>
                    </div>
                @endif

                @if (!empty($button_text))
                    <a href="{{ $button_link ?? '#' }}" class="bravo-info-image-button">
                        <span>{{$button_text}}</span>
                    </a>
                @endif
            </div>

            <div class="bravo-info-image-media">
                @if (!empty($image_id))
                    <img src="{{ get_file_url($image_id, 'full') }}" alt="Image">
                @endif
            </div>
        </div>
    </div>
</div>