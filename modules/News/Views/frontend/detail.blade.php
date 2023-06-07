@extends('layouts.app')
@push('css')
<link href="{{ asset('dist/frontend/module/news/css/news.css?_ver='.config('app.asset_version')) }}" rel="stylesheet">
    <link href="{{ asset('dist/frontend/css/app.css?_ver='.config('app.asset_version')) }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset("libs/daterange/daterangepicker.css") }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset("libs/ion_rangeslider/css/ion.rangeSlider.min.css") }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset("libs/fotorama/fotorama.css") }}" />
    <link href="https://to-mongolia.gcomm.app/libs/carousel-2/owl.carousel.css" rel="stylesheet">
    <link href="https://to-mongolia.gcomm.app/custom-css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://to-mongolia.gcomm.app/libs/daterange/daterangepicker.css">
    <link href="https://to-mongolia.gcomm.app/dist/frontend/css/app.css?_ver=2.6.0" rel="stylesheet">
    <link href="https://to-mongolia.gcomm.app/dist/frontend/css/notification.css" rel="newest stylesheet">
    <link href="https://to-mongolia.gcomm.app/libs/select2/css/select2.min.css" rel="stylesheet">
    <link href="https://to-mongolia.gcomm.app/libs/icofont/icofont.min.css" rel="stylesheet">
    <link href="https://to-mongolia.gcomm.app/libs/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="https://to-mongolia.gcomm.app/libs/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="https://to-mongolia.gcomm.app/libs/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="canonical" href="https://to-mongolia.gcomm.app">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" id="google-font-css-css" href="https://fonts.googleapis.com/css?family=Poppins%3A300%2C400%2C500%2C600&amp;display=swap" type="text/css" media="all">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
@endpush
@section('content')
<div class="bravo-news">
    @php
        $title_page = setting_item_with_lang("news_page_list_title");
        if(!empty($custom_title_page)){
            $title_page = $custom_title_page;
        }
    @endphp

    <div class="d-none d-md-block">
        @include('Template::frontend.blocks.sub-features.index', ['list_item' => $subFeatures, 'style' => 'icon'])
    </div>
    <div class="d-md-none bravo-sub-features-container">
        @include('Template::frontend.blocks.sub-features.index', ['list_item' => $subFeatures, 'style' => 'icon'])
    </div>

    @if(!empty($title_page))
        <div class="bravo_banner" @if($bg = setting_item("news_page_list_banner")) style="background-image: url({{get_file_url($bg,'full')}})" @endif >
            <div class="container">
                <h1>
                @foreach($breadcrumbs as $breadcrumb)
                    @if($breadcrumb['name']!='News')
                        {{$breadcrumb['name']}}
                    @endif
                @endforeach
                </h1>
            </div>
        </div>
    @endif
    <!-- @include('News::frontend.layouts.details.news-breadcrumb') -->
    <div class="g-filter-item" style="padding:0px!important;">
        <div class="item-content tab-contents" style="margin-top:0px; display:block!important;">
            <ul class="nav nav-tabs" id="myTab" role="tablist" style="border:none; justify-content: center; margin-top:20px; margin-bottom:20px;">
                @foreach($breadcrumbs as $breadcrumb)
                    @if($breadcrumb['name']=='Shop' || $breadcrumb['name']=='Cashmere' || $breadcrumb['name']=='Departmentstore' || $breadcrumb['name']=='Luxury' || $breadcrumb['name']=='Recommended')
                        <li class="nav-item" href="/news/Cashmere" style="text-align: center;">
                            <a href="/news/Cashmere"><img data-toggle="tooltip" href="/news/Cashmere" data-placement="top" src="{{asset('icon/cashmere.svg')}}"></a>
                            <a href="/news/Cashmere" style="text-align:center; color:black;" class="nav-link" data-toggle="/news/Cashmere" role="tab" aria-controls="company" aria-selected="true">캐시미어</a>
                        </li>
                        <li class="nav-item" href="/news/Departmentstore" style="text-align: center;">
                        <a href="/news/Departmentstore"><img data-toggle="tooltip" href="/news/Departmentstore" data-placement="top" src="{{asset('icon/departmentstore.svg')}}"></a>
                            <a href="/news/Departmentstore" style="text-align:center; color:black;" class="nav-link" data-toggle="/news/Departmentstore" role="tab" aria-controls="company" aria-selected="true">백화점</a>
                        </li>
                        <li class="nav-item" href="/news/Luxury" style="text-align: center;">
                        <a href="/news/Luxury"><img data-toggle="tooltip" href="/news/Luxury" data-placement="top" src="{{asset('icon/luxury.svg')}}"></a>
                            <a href="/news/Luxury" style="text-align:center; color:black;" class="nav-link" data-toggle="/news/Luxury" role="tab" aria-controls="company" aria-selected="true">명품</a>
                        </li>
                        <li class="nav-item" href="/news/Recommended" style="text-align: center;">
                        <a href="/news/Recommended"><img data-toggle="tooltip" href="/news/Recommended" data-placement="top" src="{{asset('icon/recommended.svg')}}"></a>
                            <a href="/news/Recommended" style="text-align:center; color:black;" class="nav-link" data-toggle="/news/Recommended" role="tab" aria-controls="company" aria-selected="true">아이템</a>
                        </li>
                    @elseif($breadcrumb['name']=='Beauty' || $breadcrumb['name']=='Hair' || $breadcrumb['name']=='Nail' || $breadcrumb['name']=='Massage' || $breadcrumb['name']=='Skin')
                        <li class="nav-item" href="/news/Hair" style="text-align: center;">
                        <a href="/news/Hair"><img data-toggle="tooltip" href="/news/Hair" data-placement="top" src="{{asset('icon/hair.svg')}}"></a>
                            <a href="/news/Hair" style="text-align:center; color:black;" class="nav-link" data-toggle="/news/Hair" role="tab" aria-controls="company" aria-selected="true">헤어</a>
                        </li>
                        <li class="nav-item" href="/news/Nail" style="text-align: center;">
                        <a href="/news/Nail"><img data-toggle="tooltip" href="/news/Nail" data-placement="top" src="{{asset('icon/nail.svg')}}"></a>
                            <a href="/news/Nail" style="text-align:center; color:black;" class="nav-link" data-toggle="/news/Nail" role="tab" aria-controls="company" aria-selected="true">네일</a>
                        </li>
                        <li class="nav-item" href="/news/Massage" style="text-align: center;">
                        <a href="/news/Massage"><img data-toggle="tooltip" href="/news/Massage" data-placement="top" src="{{asset('icon/massage.svg')}}"></a>
                            <a href="/news/Massage" style="text-align:center; color:black;" class="nav-link" data-toggle="/news/Massage" role="tab" aria-controls="company" aria-selected="true">마사지</a>
                        </li>
                        <li class="nav-item" href="/news/Skin" style="text-align: center;">
                        <a href="/news/Skin"><img data-toggle="tooltip" href="/news/Skin" data-placement="top" src="{{asset('icon/skin.svg')}}"></a>
                            <a href="/news/Skin" style="text-align:center; color:black;" class="nav-link" data-toggle="/news/Skin" role="tab" aria-controls="company" aria-selected="true">스킨케어</a>
                        </li>
                    @elseif($breadcrumb['name']=='Exchange' || $breadcrumb['name']=='Exrate' || $breadcrumb['name']=='Finances' || $breadcrumb['name']=='Careservice')
                        <li class="nav-item" href="/news/Exrate" style="text-align: center;">
                        <a href="/news/Exrate"><img data-toggle="tooltip" href="/news/Exrate" data-placement="top" src="{{asset('icon/exrate.svg')}}"></a>
                            <a href="/news/Exrate" style="text-align:center; color:black;" class="nav-link" data-toggle="/news/Exrate" role="tab" aria-controls="company" aria-selected="true">환율 정보</a>
                        </li>
                        <li class="nav-item" href="/news/Finances" style="text-align: center;">
                        <a href="/news/Finances"><img data-toggle="tooltip" href="/news/Finances" data-placement="top" src="{{asset('icon/finances.svg')}}"></a>
                            <a href="/news/Finances" style="text-align:center; color:black;" class="nav-link" data-toggle="/news/Finances" role="tab" aria-controls="company" aria-selected="true">금융</a>
                        </li>
                        <li class="nav-item" href="/news/Careservice" style="text-align: center;">
                        <a href="/news/Careservice"><img data-toggle="tooltip" href="/news/Careservice" data-placement="top" src="{{asset('icon/careservice.svg')}}"></a>
                            <a href="/news/Careservice" style="text-align:center; color:black;" class="nav-link" data-toggle="/news/Careservice" role="tab" aria-controls="company" aria-selected="true">Care Service</a>
                        </li>
                    @endif
                @endforeach                                
            </ul>
        </div>
    </div>
    <div class="bravo_content">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    @include('News::frontend.layouts.details.news-detail')
                </div>
                <div class="col-md-2">
                </div>
                <div class="col-md-12">
                    <div class="bravo_banner" @if($bg = setting_item("news_page_list_banner")) style="background-image: url({{get_file_url($bg,'full')}})" @endif >
                        <div class="container">
                            <h1>
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top:20px;">
                    <div class="bravo-wrap">
                        <div class="page-template-content">
                            @include('Tour::frontend.blocks.list-tour.index', $listTour)
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection