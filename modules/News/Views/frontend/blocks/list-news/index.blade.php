<div class="bravo-list-news">
    <div class="container" style="padding-top:25px;">
        @if($title)
            <div class="title" style="font-weight:500; margin-bottom:10px;">
            <strong>{{$title}}</strong>
                @if(!empty($desc))
                    <div class="sub-title">
                        {{$desc}}
                    </div>
                @endif
            </div>
        @endif
        <div class="list-item">
            <div class="row">
                @foreach($rows as $row)
                    <div class="col-lg-4 col-md-6">
                        @include('News::frontend.blocks.list-news.loop')
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>