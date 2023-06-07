@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__("Room Management")}}</h1>
            <div class="title-actions">
                <a href="{{route('hotel.admin.room.availability.index',['hotel_id'=>$hotel->id])}}" class="btn btn-warning btn-xs"><i class="fa fa-calendar"></i> {{__("Room Availability")}}</a>
                <a href="{{route('hotel.admin.edit',['id'=>$hotel->id])}}" class="btn btn-info btn-xs"><i class="fa fa-hand-o-right"></i> {{__("Back to hotel")}}</a>
            </div>
        </div>
        @include('admin.message')
        <div class="row">
            <div class="col-md-4">
                <form novalidate class="needs-validation" action="{{route('hotel.admin.room.store',['hotel_id'=>$hotel->id,'id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])}}" method="post">
                    <div class="panel">
                        <div class="panel-title"><strong>{{__("Add Room")}}</strong></div>
                        <div class="panel-body">
                            @csrf
                            @include('Hotel::admin.room.form')
                        </div>
                        <div class="panel-footer">
                            <button class="btn btn-success" type="submit">
                                <svg class="mr-1" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.833 2.5v2.833c0 .467 0 .7.091.879.08.156.208.284.364.364.179.09.412.09.879.09h5.666c.467 0 .7 0 .879-.09a.833.833 0 0 0 .364-.364c.09-.179.09-.412.09-.879v-2m0 14.167v-5.333c0-.467 0-.7-.09-.879a.833.833 0 0 0-.364-.364c-.179-.09-.412-.09-.879-.09H7.167c-.467 0-.7 0-.879.09a.833.833 0 0 0-.364.364c-.09.179-.09.412-.09.879V17.5M17.5 7.771V13.5c0 1.4 0 2.1-.273 2.635a2.5 2.5 0 0 1-1.092 1.092c-.535.273-1.235.273-2.635.273h-7c-1.4 0-2.1 0-2.635-.273a2.5 2.5 0 0 1-1.093-1.092C2.5 15.6 2.5 14.9 2.5 13.5v-7c0-1.4 0-2.1.272-2.635a2.5 2.5 0 0 1 1.093-1.093C4.4 2.5 5.1 2.5 6.5 2.5h5.729c.407 0 .611 0 .803.046.17.04.333.108.482.2.168.103.312.247.6.535l2.605 2.605c.288.288.432.432.535.6.092.15.16.312.2.482.046.192.046.396.046.803z" stroke="#fff" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                {{__("Add Room")}}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-8">
                <div class="filter-div d-flex justify-content-between ">
                    <div class="col-left">
                        @if(!empty($rows))
                            <form method="post" action="{{route('hotel.admin.room.bulkEdit')}}" class="filter-form filter-form-left d-flex justify-content-start">
                                {{csrf_field()}}
                                <select name="action" class="form-control">
                                    <option value="">{{__(" Bulk Actions ")}}</option>
                                    <option value="publish">{{__(" Publish ")}}</option>
                                    <option value="draft">{{__(" Move to Draft ")}}</option>
                                    <option value="pending">{{__("Move to Pending")}}</option>
                                    {{--<option value="clone">{{__(" Clone ")}}</option>--}}
                                    <option value="delete">{{__(" Delete ")}}</option>
                                </select>
                                <button data-confirm="{{__("Do you want to delete?")}}" class="btn-info btn btn-icon dungdt-apply-form-btn" type="button">{{__('Apply')}}</button>
                            </form>
                        @endif
                    </div>
                    <div class="col-right">
                        <p><i>{{__('Found :total items',['total'=>$rows->total()])}}</i></p>
                    </div>
                </div>
                <div class="panel">
                    <div class="panel-body">
                        <form action="" class="bravo-form-item">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th width="45px"><input type="checkbox" class="check-all"></th>
                                        <th> {{ __('Room name')}}</th>
                                        <th width="100px"> {{ __('Number')}}</th>
                                        <th width="100px"> {{ __('Price')}}</th>
                                        <th width="100px"> {{ __('Status')}}</th>
                                        <th width="100px"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($rows->total() > 0)
                                        @foreach($rows as $row)
                                            <tr class="{{$row->status}}">
                                                <td><input type="checkbox" name="ids[]" class="check-item" value="{{$row->id}}">
                                                </td>
                                                <td class="title">
                                                    <a href="{{route('hotel.admin.room.edit',['hotel_id'=>$hotel->id,'id'=>$row->id])}}">{{$row->title}}</a>
                                                </td>
                                                <td>{{$row->number}}</td>
                                                <td>{{format_money($row->price)}}</td>
                                                <td><span class="badge badge-{{ $row->status }}">{{ $row->status }}</span></td>
                                                <td>
                                                    <a href="{{route('hotel.admin.room.edit',['id'=>$row->id,'hotel_id'=>$hotel->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> {{__('Edit')}}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7">{{__("No room found")}}</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </form>
                        {{$rows->appends(request()->query())->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
