@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__("Translate Manager for: :name",['name'=>$lang->name])}}</h1>
        </div>
        @include('admin.message')
        <div class="row">
            <div class="col-md-12">
                <div class="filter-div d-flex justify-content-between">
                    <div class="col-left">
                        <form method="get" action="" class="filter-form filter-form-left d-flex justify-content-start flex-column flex-sm-row">
                            <select name="type" class="form-control">
                                <option value="">{{__("All text")}}</option>
                                <option @if(Request()->type == 'not_translated') selected @endif value="not_translated">{{__("Not translated")}}</option>
                                <option @if(Request()->type == 'translated') selected @endif value="translated">{{__("Translated")}}</option>
                            </select>
                            <select name="search_by" class="form-control">
                                <option value="">{{__("Search By")}}</option>
                                <option @if(Request()->search_by == 'original_text') selected @endif value="original_text">{{__("Original Text")}}</option>
                                <option @if(Request()->search_by == 'translated_text') selected @endif value="translated_text">{{__("Translated Text")}}</option>
                            </select>
                            <input type="text" name="s" value="{{ Request()->s }}" placeholder="{{__('Search by key ...')}}" class="form-control">
                            <button class="btn-info btn btn-icon" type="submit">{{__('Filter')}}</button>
                        </form>
                    </div>
                    <div class="col-left">
                        <p><i>{{__('Found :total texts',['total'=>$origins->total()])}}</i></p>
                    </div>
                </div>
                <div class="panel">
                    <div class="panel-title">{{__("Translate")}}</div>
                    <div class="panel-body">
                        <form action="{{route('language.admin.translations.store',['id'=>$lang->id])}}" method="post">
                            @csrf
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th width="50px"></th>
                                    <th width="50%">{{__("Origin")}}</th>
                                    <th>{{__("Translated")}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($origins as $k=>$item)
                                    <tr>
                                        <td>{{$origins->firstItem() + $k}}</td>
                                        <td>
                                            {{$item->string}}
                                        </td>
                                        <td>
                                            <textarea name="translate[{{$item->id}}]" class="form-control">{{$item->translate}}</textarea>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="text-center">
                                <button class="btn btn-primary">
                                    <svg class="mr-1" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.833 2.5v2.833c0 .467 0 .7.091.879.08.156.208.284.364.364.179.09.412.09.879.09h5.666c.467 0 .7 0 .879-.09a.833.833 0 0 0 .364-.364c.09-.179.09-.412.09-.879v-2m0 14.167v-5.333c0-.467 0-.7-.09-.879a.833.833 0 0 0-.364-.364c-.179-.09-.412-.09-.879-.09H7.167c-.467 0-.7 0-.879.09a.833.833 0 0 0-.364.364c-.09.179-.09.412-.09.879V17.5M17.5 7.771V13.5c0 1.4 0 2.1-.273 2.635a2.5 2.5 0 0 1-1.092 1.092c-.535.273-1.235.273-2.635.273h-7c-1.4 0-2.1 0-2.635-.273a2.5 2.5 0 0 1-1.093-1.092C2.5 15.6 2.5 14.9 2.5 13.5v-7c0-1.4 0-2.1.272-2.635a2.5 2.5 0 0 1 1.093-1.093C4.4 2.5 5.1 2.5 6.5 2.5h5.729c.407 0 .611 0 .803.046.17.04.333.108.482.2.168.103.312.247.6.535l2.605 2.605c.288.288.432.432.535.6.092.15.16.312.2.482.046.192.046.396.046.803z" stroke="#fff" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    {{__('Save Changes')}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="d-flex justify-content-end">{{$origins->links()}}</div>
            </div>
        </div>
    </div>
@endsection
