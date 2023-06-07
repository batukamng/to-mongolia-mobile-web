@extends('layouts.user')
@section('content')
    <h2 class="title-bar">
        {{__("Update verification data")}}
    </h2>
    @include('admin.message')
    <div class="booking-history-manager">
        <form action="{{route("user.verification.store")}}" method="post">
            @csrf
            @foreach($fields as $field)
                @switch($field['type'])
                    @case("email")
                    @include('User::frontend.verification.fields.email')
                    @break
                    @case("phone")
                    @include('User::frontend.verification.fields.phone')
                    @break
                    @case("file")
                    @include('User::frontend.verification.fields.file')
                    @break
                    @case("multi_files")
                    @include('User::frontend.verification.fields.multi_files')
                    @break
                    @case('text')
                    @default
                    @include('User::frontend.verification.fields.text')
                    @break
                @endswitch
            @endforeach
            <hr>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-4">
                    <button class="btn btn-success">
                        <svg class="mr-1" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.833 2.5v2.833c0 .467 0 .7.091.879.08.156.208.284.364.364.179.09.412.09.879.09h5.666c.467 0 .7 0 .879-.09a.833.833 0 0 0 .364-.364c.09-.179.09-.412.09-.879v-2m0 14.167v-5.333c0-.467 0-.7-.09-.879a.833.833 0 0 0-.364-.364c-.179-.09-.412-.09-.879-.09H7.167c-.467 0-.7 0-.879.09a.833.833 0 0 0-.364.364c-.09.179-.09.412-.09.879V17.5M17.5 7.771V13.5c0 1.4 0 2.1-.273 2.635a2.5 2.5 0 0 1-1.092 1.092c-.535.273-1.235.273-2.635.273h-7c-1.4 0-2.1 0-2.635-.273a2.5 2.5 0 0 1-1.093-1.092C2.5 15.6 2.5 14.9 2.5 13.5v-7c0-1.4 0-2.1.272-2.635a2.5 2.5 0 0 1 1.093-1.093C4.4 2.5 5.1 2.5 6.5 2.5h5.729c.407 0 .611 0 .803.046.17.04.333.108.482.2.168.103.312.247.6.535l2.605 2.605c.288.288.432.432.535.6.092.15.16.312.2.482.046.192.046.396.046.803z" stroke="#fff" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        {{__('Save Changes')}}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('js')
    <!-- Modal -->
    <div class="modal fade" id="modalVerifyPhone" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Verify Phone')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" name="verified_phone_code" class="form-control" id="verified_phone_code">
                    <input type="hidden" name="verified_phone" class="form-control" id="verified_phone">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                    <button type="button" onclick="verifyPhone()" class="btn btn-primary">{{__('Verify')}}</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var ajaxReady = 1;
        var phone ='';
        function sendCodeVerifyPhone(inputName,inputLabel) {
            if(ajaxReady==1){
                phone = $("input[name='"+inputName+"']").val();

                $.ajax({
                    url: '{{route('user.verification.phone.sendCode')}}',
                    data: {
                        phone: phone,
                        inputName: inputName,
                        inputLabel: inputLabel,
                        _token: "{{csrf_token()}}",
                    },
                    dataType: 'json',
                    type: 'post',
                    beforeSend: function (xhr) {
                        ajaxReady = 0;
                    },
                    success: function (res) {
                        if(res.status==1){
                            if(res.verified==1){
                                alert(res.message)
                            }
                            if(res.action=='openModalVerify'){
                                $("#modalVerifyPhone").modal('toggle');

                            }
                        }else{
                            alert(res.message)

                        }
                        ajaxReady = 1;

                    },
                    error:function () {
                        ajaxReady = 1;
                    }
                })
            }
        }

        function verifyPhone() {
                var code = $("#verified_phone_code").val();
                $.ajax({
                    url: '{{route('user.verification.phone.field')}}',
                    data: {
                        code: code,
                        _token: "{{csrf_token()}}",
                    },
                    dataType: 'json',
                    type: 'post',
                    success: function (res) {
                        if(res.status==1){
                            $("#modalVerifyPhone").modal('toggle');
                            window.location.reload();
                        }else{
                            alert(res.message)
                        }
                    }
                })

        }
    </script>



@endpush
