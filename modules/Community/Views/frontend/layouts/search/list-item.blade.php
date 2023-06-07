<div class="row">
    <div class="col-lg-12 col-md-12">
        @include('Community::frontend.layouts.search.filter-search')
    </div>
    <div class="col-lg-12 col-md-12">
        <div class="bravo-list-item">
            <div class="topbar-search">
                <div class="control" style="margin-top:10px; justify-content:space-between;">
                    @include('Community::frontend.layouts.search.orderby')
                </div>
            </div>
            <!-- <div class="topbar-search">
                <div class="control">
                    <div class="item">
                        <a class="btn btn-light" style="background-color:#088ab2; color:white; border-radius:100px;" href="/user/community">{{__("동행 찾기")}}</a>
                    </div>
                </div>
            </div> -->
            <div class="list-item">
                <div class="row">
                    @if($rows->total() > 0)
                        @foreach($rows as $row)
                            <div class="col-lg-4 col-md-6">
                                @include('Community::frontend.layouts.search.loop-grid')
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg-12">
                            {{__("Community not found")}}
                        </div>
                    @endif
                </div>
            </div>
            <div class="bravo-pagination">
                {{$rows->appends(request()->query())->links()}}
                @if($rows->total() > 0)
                    <span class="count-string">{{ __("Showing :from - :to of :total Communitys",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()]) }}</span>
                @endif
            </div>
        </div>
    </div>
</div>