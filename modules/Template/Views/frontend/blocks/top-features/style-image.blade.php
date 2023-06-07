<div class="container">
    <div class="bravo-top-features">
        <div class="top-features-grid">
            @foreach($list_item as $k=>$item)
                <a href="{{ $item['link'] }}" class="card">
                    <img src="{{ get_file_url($item['image_id'],'full') }}" class="card-img" alt="Image">
                    <div class="card-img-overlay">
                        <h5 class="card-title">{{ $item['title'] }}</h5>
                        <div class="card-text">
                            <!-- <span>상품보기</span> -->
                            <!-- <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="m7.5 15 5-5-5-5" stroke="#fff" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg> -->
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>