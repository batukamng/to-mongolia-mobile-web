@extends ('admin.layouts.app')
@section ('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__('All Reply')}}</h1>
        </div>
        @include('admin.message')
        <div class="row">
            <div class="col-md-4">
                <div class="panel">
                    <form action="{{route('report.admin.enquiry.replyStore',['enquiry'=>$enquiry])}}" method="post">
                        @csrf
                    <div class="panel-title"><strong>{{__("Add Reply")}}</strong></div>
                    <div class="panel-body">
                            <div class="form-group">
                                <label>{{__("Client Message:")}}</label>
                                <div><strong>{{__("Name:")}}</strong> {{$enquiry->name}}</div>
                                <div><strong>{{__("Email:")}}</strong> {{$enquiry->email}}</div>
                                <div><strong>{{__("Phone:")}}</strong> {{$enquiry->phone}}</div>
                                <div><strong>{{__("Content:")}}</strong> {{$enquiry->note}}</div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>{{__("Reply Content")}}</label>
                                <textarea required name="content" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-primary" type="submit">
                            <svg class="mr-1" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.833 2.5v2.833c0 .467 0 .7.091.879.08.156.208.284.364.364.179.09.412.09.879.09h5.666c.467 0 .7 0 .879-.09a.833.833 0 0 0 .364-.364c.09-.179.09-.412.09-.879v-2m0 14.167v-5.333c0-.467 0-.7-.09-.879a.833.833 0 0 0-.364-.364c-.179-.09-.412-.09-.879-.09H7.167c-.467 0-.7 0-.879.09a.833.833 0 0 0-.364.364c-.09.179-.09.412-.09.879V17.5M17.5 7.771V13.5c0 1.4 0 2.1-.273 2.635a2.5 2.5 0 0 1-1.092 1.092c-.535.273-1.235.273-2.635.273h-7c-1.4 0-2.1 0-2.635-.273a2.5 2.5 0 0 1-1.093-1.092C2.5 15.6 2.5 14.9 2.5 13.5v-7c0-1.4 0-2.1.272-2.635a2.5 2.5 0 0 1 1.093-1.093C4.4 2.5 5.1 2.5 6.5 2.5h5.729c.407 0 .611 0 .803.046.17.04.333.108.482.2.168.103.312.247.6.535l2.605 2.605c.288.288.432.432.535.6.092.15.16.312.2.482.046.192.046.396.046.803z" stroke="#fff" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            {{__('Add New')}}
                        </button>
                    </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="p-3 bg-white rounded shadow-sm">
                    <h6 class="border-bottom border-gray pb-2 mb-0">{{__('Recent updates')}}</h6>
                    @foreach($rows as $row)
                        <div class="media text-muted pt-3">
                            <div class="bd-placeholder-img mr-2 rounded">
                                <img src="{{$row->author->avatar_url}}" class="bd-placeholder-img mr-2 rounded" width="32" height="32" alt="">
                            </div>
                            <div class="d-flex flex-justify-between flex-grow-1">
                                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray flex-grow-1">
                                    <strong class="d-block text-gray-dark">{{$row->author->display_name}}</strong>
                                    <div>
                                        {!! clean($row->content) !!}
                                    </div>
                                </div>
                                <div class="flex-shrink-0">{{display_datetime($row->created_at)}}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-end">
                    {{$rows->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
