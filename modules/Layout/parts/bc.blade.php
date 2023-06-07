@if(!empty($breadcrumbs))
    <div class="blog-breadcrumb hidden-xs">
        <div class="container">
            <ol class="ul" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li class="" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="{{url('/')}}" itemprop="item"><span itemprop="name">{{__('Home')}}</span></a>
                    <meta itemprop="position" content="1" /></li>
                @foreach($breadcrumbs as $k=>$breadcrumb)
                    <li class=" {{$breadcrumb['class'] ?? ''}}" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        @if(!empty($breadcrumb['url']))
                            <a href="{{url($breadcrumb['url'])}}" itemscope itemtype="https://schema.org/WebPage" itemprop="item" itemid="{{url($breadcrumb['url'])}}"><span itemprop="name">
                            @if($breadcrumb['name']=='Boat')
                                <span itemprop="name">Restaurant</span>
                            @else($breadcrumb['name']!='Boat')
                                <span itemprop="name">{{$breadcrumb['name']}}</span>
                            @endif</span></a>
                        @else
                            @if($breadcrumb['name']=='Boat')
                                <span itemprop="name">Restaurant</span>
                            @else($breadcrumb['name']!='Boat')
                                <span itemprop="name">{{$breadcrumb['name']}}</span>
                            @endif
                        @endif
                        <meta itemprop="position" content="{{$k + 2}}" />
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
@endif
