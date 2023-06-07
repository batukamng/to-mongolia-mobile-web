<div class="row">
    <div class="col-lg-12 col-md-12">
        @include('Car::frontend.layouts.search.filter-search')
    </div>
    <div class="col-lg-12 col-md-12">
        <div class="bravo-list-item">
            <div class="topbar-search">
                <h2 class="text">
                </h2>
                <div class="control">
                </div>
            </div>
            <div class="list-item">
                <div class="row">
                    @if($rows->total() > 0)
                        @foreach($rows as $row)
                            <div class="col-lg-3 col-md-6">
                                @include('Car::frontend.layouts.search.loop-grid')
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg-12">
                            {{__("Car not found")}}
                        </div>
                    @endif
                </div>
            </div>
            <div class="bravo-pagination">
                {{$rows->appends(request()->query())->links()}}
                @if($rows->total() > 0)
                    <span class="count-string">{{ __("Showing :from - :to of :total Cars",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()]) }}</span>
                @endif
            </div>
        </div>
    </div>
</div>
