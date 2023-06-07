@if($list_item)
    <div class="container">
        <div class="bravo-slide-banners">
            <div class="row">
                <div class="col-12">
                    <div class="list-item owl-carousel">
                        @foreach($list_item as $k=>$item)
                            <div class="item">
                                <img src="{{ get_file_url($item['image_id'],'full') }}" alt="Image">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
