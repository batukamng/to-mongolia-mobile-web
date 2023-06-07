<div class="container">
    <div class="bravo-list-car layout_{{$style_list}}" style="margin:0px; padding-top:10px;">
        @if($title)
        <div class="title" style="font-weight:500; margin-bottom:10px;">
        <strong>{{$title}}</strong>
        </div>
        @endif
        @if($desc)
            <div class="sub-title">
                {{$desc}}
            </div>
        @endif
        <div class="list-item">
            @if($style_list === "normal")
                <div class="row">
                    @foreach($rows as $row)
                        <div class="col-lg-{{$col ?? 3}} col-md-6">
                            @include('Car::frontend.layouts.search.loop-grid')
                        </div>
                    @endforeach
                </div>
            @endif
            @if($style_list === "carousel")
                <div class="owl-carousel">
                    @foreach($rows as $row)
                        @include('Car::frontend.layouts.search.loop-grid')
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
