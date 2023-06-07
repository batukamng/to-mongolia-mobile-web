@extends('layouts.user')
@section('content')
    <h2 class="title-bar">
        {{__("Settings")}}
        <a href="{{route('user.change_password')}}" class="btn-change-password">{{__("Change Password")}}</a>
    </h2>
    @include('admin.message')
    <form action="{{route('user.profile.update')}}" method="post" class="input-has-icon">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-title">
                    <strong>{{__("Personal Information")}}</strong>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__("First name")}}</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{$dataUser->first_name}}</label>
                        </div>
                    </div>
                </div>

                @if($is_vendor_access)
                    <div class="form-group">
                        <label>{{__("Business name")}}</label>
                        <input type="text" value="{{old('business_name',$dataUser->business_name)}}" name="business_name" placeholder="{{__("Business name")}}" class="form-control">
                        <i class="fa fa-user input-icon"></i>
                    </div>
                @endif
                <div class="form-group">
                    <label>{{__("User name")}}</label>
                    <input type="text" name="user_name" value="{{old('user_name',$dataUser->user_name)}}" placeholder="{{__("User name")}}" class="form-control">
                    <i class="fa fa-user input-icon"></i>
                </div>
                <div class="form-group">
                    <label>{{__("E-mail")}}</label>
                    <input type="text" name="email" value="{{old('email',$dataUser->email)}}" placeholder="{{__("E-mail")}}" class="form-control">
                    <i class="fa fa-envelope input-icon"></i>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__("First name")}}</label>
                            <input type="text" value="{{old('first_name',$dataUser->first_name)}}" name="first_name" placeholder="{{__("First name")}}" class="form-control">
                            <i class="fa fa-user input-icon"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__("Last name")}}</label>
                            <input type="text" value="{{old('last_name',$dataUser->last_name)}}" name="last_name" placeholder="{{__("Last name")}}" class="form-control">
                            <i class="fa fa-user input-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{__("Phone Number")}}</label>
                    <input type="text" value="{{old('phone',$dataUser->phone)}}" name="phone" placeholder="{{__("Phone Number")}}" class="form-control">
                    <i class="fa fa-phone input-icon"></i>
                </div>
                <div class="form-group">
                    <label>{{__("Birthday")}}</label>
                    <input type="text" value="{{ old('birthday',$dataUser->birthday? display_date($dataUser->birthday) :'') }}" name="birthday" placeholder="{{__("Birthday")}}" class="form-control date-picker">
                    <i class="fa fa-birthday-cake input-icon"></i>
                </div>
                <div class="form-group">
                    <label>{{__("About Yourself")}}</label>
                    <textarea name="bio" rows="5" class="form-control">{{old('bio',$dataUser->bio)}}</textarea>
                </div>
                <div class="form-group">
                    <label>{{__("Avatar")}}</label>
                    <div class="upload-btn-wrapper">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    {{__("Browse")}}… <input type="file">
                                </span>
                            </span>
                            <input type="text" data-error="{{__("Error upload...")}}" data-loading="{{__("Loading...")}}" class="form-control text-view" readonly value="{{ get_file_url( old('avatar_id',$dataUser->avatar_id) ) ?? $dataUser->getAvatarUrl()?? __("No Image")}}">
                        </div>
                        <input type="hidden" class="form-control" name="avatar_id" value="{{ old('avatar_id',$dataUser->avatar_id)?? ""}}">
                        <img class="image-demo" src="{{ get_file_url( old('avatar_id',$dataUser->avatar_id) ) ??  $dataUser->getAvatarUrl() ?? ""}}"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-title">
                    <strong>{{__("Location Information")}}</strong>
                </div>
                <div class="form-group">
                    <label>{{__("Address Line 1")}}</label>
                    <input type="text" value="{{old('address',$dataUser->address)}}" name="address" placeholder="{{__("Address")}}" class="form-control">
                    <i class="fa fa-location-arrow input-icon"></i>
                </div>
                <div class="form-group">
                    <label>{{__("Vendor or Guide")}}</label>
                    <!-- <input type="text" value="{{old('address2',$dataUser->address2)}}" name="address2" placeholder="{{__("Address2")}}" class="form-control"> -->
                    <!-- <i class="fa fa-location-arrow input-icon"></i> -->
                    <select name="address2" class="form-control">
                        <option value="">{{old('address2',$dataUser->address2)}}</option>
                            <option>Vendor</option>
                            <option>Guide</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>{{__("City")}}</label>
                    <input type="text" value="{{old('city',$dataUser->city)}}" name="city" placeholder="{{__("City")}}" class="form-control">
                    <i class="fa fa-street-view input-icon"></i>
                </div>
                <div class="form-group">
                    <label>{{__("State")}}</label>
                    <input type="text" value="{{old('state',$dataUser->state)}}" name="state" placeholder="{{__("State")}}" class="form-control">
                    <i class="fa fa-map-signs input-icon"></i>
                </div>
                <div class="form-group">
                    <label>{{__("Country")}}</label>
                    <select name="country" class="form-control">
                        <option value="">{{__('-- Select --')}}</option>
                        @foreach(get_country_lists() as $id=>$name)
                            <option @if((old('country',$dataUser->country ?? '')) == $id) selected @endif value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>{{__("Zip Code")}}</label>
                    <input type="text" value="{{old('zip_code',$dataUser->zip_code)}}" name="zip_code" placeholder="{{__("Zip Code")}}" class="form-control">
                    <i class="fa fa-map-pin input-icon"></i>
                </div>

            </div>
            <div class="col-md-12">
                <hr>
                <button class="btn btn-primary" type="submit">
                    <svg class="mr-1" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.833 2.5v2.833c0 .467 0 .7.091.879.08.156.208.284.364.364.179.09.412.09.879.09h5.666c.467 0 .7 0 .879-.09a.833.833 0 0 0 .364-.364c.09-.179.09-.412.09-.879v-2m0 14.167v-5.333c0-.467 0-.7-.09-.879a.833.833 0 0 0-.364-.364c-.179-.09-.412-.09-.879-.09H7.167c-.467 0-.7 0-.879.09a.833.833 0 0 0-.364.364c-.09.179-.09.412-.09.879V17.5M17.5 7.771V13.5c0 1.4 0 2.1-.273 2.635a2.5 2.5 0 0 1-1.092 1.092c-.535.273-1.235.273-2.635.273h-7c-1.4 0-2.1 0-2.635-.273a2.5 2.5 0 0 1-1.093-1.092C2.5 15.6 2.5 14.9 2.5 13.5v-7c0-1.4 0-2.1.272-2.635a2.5 2.5 0 0 1 1.093-1.093C4.4 2.5 5.1 2.5 6.5 2.5h5.729c.407 0 .611 0 .803.046.17.04.333.108.482.2.168.103.312.247.6.535l2.605 2.605c.288.288.432.432.535.6.092.15.16.312.2.482.046.192.046.396.046.803z" stroke="#fff" stroke-width="1.667" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    {{__('Save Changes')}}
                </button>
            </div>
        </div>
    </form>
    @if(!empty(setting_item('user_enable_permanently_delete')) and !is_admin())
    <hr>
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-danger">
                {{__("Delete account")}}
            </h4>
            <div class="mb-4 mt-2">
                {!! clean(setting_item_with_lang('user_permanently_delete_content','',__('Your account will be permanently deleted. Once you delete your account, there is no going back. Please be certain.'))) !!}
            </div>
            <a data-toggle="modal" data-target="#permanentlyDeleteAccount" class="btn btn-danger" href="">{{__('Delete your account')}}</a>
        </div>

        <!-- Modal -->
        <div class="modal  fade" id="permanentlyDeleteAccount" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('Confirm permanently delete account')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="my-3">
                            {!! clean(setting_item_with_lang('user_permanently_delete_content_confirm')) !!}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <a href="{{route('user.permanently.delete')}}" class="btn btn-danger">{{__('Confirm')}}</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endif

@endsection
