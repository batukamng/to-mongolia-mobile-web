@extends('layouts.user')
@section('content')
    <h2 class="title-bar">
        {{__("Settings")}}
    
        <a class="btn-change-password" id="more" href="#" 
    onclick="$('#show-edit').slideToggle(function(){$('.btn-change-password').html($('#show-edit').is(':visible')?'Show Edit':'Show Edit'); }); 
    $('#show-label').slideToggle(function(){$('.btn-change-password').html($('#show-label').is(':visible')?'Show Edit':'Show Label'); });">Show Edit</a>
    </h2>

    @include('admin.message')
    <form action="{{route('user.profile.update')}}" method="post" class="input-has-icon">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-title">
                    <strong>{{__("Personal Information")}}</strong>
                </div>
                <div id="show-label">
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("E-mail")}}</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{$dataUser->email}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("Phone Number")}}</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{$dataUser->phone}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <a type="button" href="{{route('user.change_password')}}" class="">{{__("Change Password")}}</a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("**********")}}</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div id="show-edit" style="display:none;">
                    @if($is_vendor_access)
                        <div class="form-group">
                            <label>{{__("Business name")}}</label>
                            <input type="text" value="{{old('business_name',$dataUser->business_name)}}" name="business_name" placeholder="{{__("Business name")}}" class="form-control">
                            <span class="input-icon">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 10c-2.114 0-3.994 1.02-5.19 2.604-.258.34-.386.511-.382.742a.743.743 0 0 0 .255.512c.181.142.432.142.934.142h8.764c.502 0 .753 0 .935-.142a.743.743 0 0 0 .255-.513c.004-.23-.125-.4-.382-.741C11.992 11.02 10.113 10 7.999 10zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" stroke="#98A2B3" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>                            
                            </span>
                        </div>
                    @endif
                    <div class="form-group">
                        <label>{{__("User name")}}</label>
                        <input type="text" name="user_name" value="{{old('user_name',$dataUser->user_name)}}" placeholder="{{__("User name")}}" class="form-control">
                        <span class="input-icon">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 10c-2.114 0-3.994 1.02-5.19 2.604-.258.34-.386.511-.382.742a.743.743 0 0 0 .255.512c.181.142.432.142.934.142h8.764c.502 0 .753 0 .935-.142a.743.743 0 0 0 .255-.513c.004-.23-.125-.4-.382-.741C11.992 11.02 10.113 10 7.999 10zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" stroke="#98A2B3" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                            
                        </span>
                    </div>
                    <div class="form-group">
                        <label>{{__("E-mail")}}</label>
                        <input type="text" name="email" value="{{old('email',$dataUser->email)}}" placeholder="{{__("E-mail")}}" class="form-control">
                        <span class="input-icon">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="m1.334 4.667 5.443 3.81c.441.308.661.463.901.522.212.053.433.053.645 0 .24-.06.46-.214.901-.522l5.443-3.81M4.534 13.332h6.933c1.12 0 1.68 0 2.108-.218a2 2 0 0 0 .874-.874c.218-.428.218-.988.218-2.108V5.867c0-1.12 0-1.68-.218-2.108a2 2 0 0 0-.874-.875c-.427-.217-.988-.217-2.108-.217H4.534c-1.12 0-1.68 0-2.108.217a2 2 0 0 0-.874.875c-.218.427-.218.987-.218 2.108v4.266c0 1.12 0 1.68.218 2.108a2 2 0 0 0 .874.874c.428.218.988.218 2.108.218z" stroke="#98A2B3" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                        
                        </span>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("First name")}}</label>
                                <input type="text" value="{{old('first_name',$dataUser->first_name)}}" name="first_name" placeholder="{{__("First name")}}" class="form-control">
                                <span class="input-icon">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 10c-2.114 0-3.994 1.02-5.19 2.604-.258.34-.386.511-.382.742a.743.743 0 0 0 .255.512c.181.142.432.142.934.142h8.764c.502 0 .753 0 .935-.142a.743.743 0 0 0 .255-.513c.004-.23-.125-.4-.382-.741C11.992 11.02 10.113 10 7.999 10zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" stroke="#98A2B3" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>                            
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("Last name")}}</label>
                                <input type="text" value="{{old('last_name',$dataUser->last_name)}}" name="last_name" placeholder="{{__("Last name")}}" class="form-control">
                                <span class="input-icon">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 10c-2.114 0-3.994 1.02-5.19 2.604-.258.34-.386.511-.382.742a.743.743 0 0 0 .255.512c.181.142.432.142.934.142h8.764c.502 0 .753 0 .935-.142a.743.743 0 0 0 .255-.513c.004-.23-.125-.4-.382-.741C11.992 11.02 10.113 10 7.999 10zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" stroke="#98A2B3" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>                            
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{__("Phone Number")}}</label>
                        <input type="text" value="{{old('phone',$dataUser->phone)}}" name="phone" placeholder="{{__("Phone Number")}}" class="form-control">
                        <span class="input-icon">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.587 5.902a9.735 9.735 0 0 0 1.897 2.673 9.734 9.734 0 0 0 2.674 1.898c.083.04.124.06.177.075a.697.697 0 0 0 .575-.098c.044-.032.082-.07.159-.146.233-.233.35-.35.466-.426a1.333 1.333 0 0 1 1.454 0c.117.076.234.193.467.426l.13.13c.354.354.531.531.627.722.192.378.192.825 0 1.203-.096.19-.273.368-.627.722l-.106.105c-.353.353-.53.53-.77.665-.266.15-.68.257-.985.256-.275-.001-.463-.054-.84-.161a12.691 12.691 0 0 1-5.522-3.25 12.692 12.692 0 0 1-3.249-5.522c-.107-.376-.16-.564-.16-.84-.002-.305.106-.719.255-.985.135-.24.312-.417.665-.77l.105-.105c.354-.354.531-.531.722-.627a1.333 1.333 0 0 1 1.203 0c.19.096.368.273.722.627l.13.13c.233.233.35.35.426.467a1.333 1.333 0 0 1 0 1.454c-.077.117-.193.233-.426.466-.076.077-.114.115-.146.16a.697.697 0 0 0-.098.574c.015.053.035.094.075.177z" stroke="#98A2B3" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                        
                        </span>
                    </div>
                </div>
                @if($is_vendor_access)
                <div class="form-group">
                    <label>{{__("Birthday")}}</label>
                    <input type="text" value="{{ old('birthday',$dataUser->birthday? display_date($dataUser->birthday) :'') }}" name="birthday" placeholder="{{__("Birthday")}}" class="form-control date-picker">
                    <span class="input-icon">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 10c-2.114 0-3.994 1.02-5.19 2.604-.258.34-.386.511-.382.742a.743.743 0 0 0 .255.512c.181.142.432.142.934.142h8.764c.502 0 .753 0 .935-.142a.743.743 0 0 0 .255-.513c.004-.23-.125-.4-.382-.741C11.992 11.02 10.113 10 7.999 10zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" stroke="#98A2B3" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>                            
                    </span>
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
                @endif
            </div>
            @if($is_vendor_access)
            <div class="col-md-6">
                <div class="form-title">
                    <strong>{{__("Location Information")}}</strong>
                </div>
                <div class="form-group">
                    <label>{{__("Address Line 1")}}</label>
                    <input type="text" value="{{old('address',$dataUser->address)}}" name="address" placeholder="{{__("Address")}}" class="form-control">
                    <span class="input-icon">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#g6wo2ey0da)">
                                <path d="M2.275 7.163c-.397-.154-.595-.232-.653-.343a.333.333 0 0 1 0-.307c.057-.112.256-.19.652-.344l11.259-4.393c.358-.14.537-.21.652-.172.099.033.177.111.21.21.038.115-.032.294-.171.652L9.83 13.725c-.155.396-.232.595-.343.653a.333.333 0 0 1-.308 0c-.111-.059-.188-.257-.343-.654L7.084 9.22c-.031-.08-.047-.121-.071-.155a.333.333 0 0 0-.078-.078.717.717 0 0 0-.155-.07L2.275 7.162z" stroke="#98A2B3" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                            <defs>
                                <clipPath id="g6wo2ey0da">
                                    <path fill="#fff" d="M0 0h16v16H0z"/>
                                </clipPath>
                            </defs>
                        </svg>
                    </span>
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
                    <span class="input-icon">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.333 4.667h3.333M6.333 7.333h3.333M6.333 10h3.333m2.333 4V4.133c0-.746 0-1.12-.145-1.405a1.333 1.333 0 0 0-.583-.583C10.986 2 10.613 2 9.866 2H6.133c-.747 0-1.12 0-1.406.145-.25.128-.455.332-.582.583-.146.285-.146.659-.146 1.405V14m9.334 0H2.666" stroke="#98A2B3" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>                        
                    </span>
                </div>
                <div class="form-group">
                    <label>{{__("State")}}</label>
                    <input type="text" value="{{old('state',$dataUser->state)}}" name="state" placeholder="{{__("State")}}" class="form-control">
                    <span class="input-icon">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.666 14V2.667m0 6h4.933c.374 0 .56 0 .703-.073a.667.667 0 0 0 .291-.291c.073-.143.073-.33.073-.703V3.067c0-.374 0-.56-.073-.703a.667.667 0 0 0-.291-.291C8.159 2 7.972 2 7.599 2H3.733c-.374 0-.56 0-.703.073a.667.667 0 0 0-.291.291c-.073.143-.073.33-.073.703v5.6zm6-5.334h4.267c.373 0 .56 0 .702.073a.666.666 0 0 1 .292.291c.072.143.072.33.072.703v4.533c0 .374 0 .56-.072.703a.666.666 0 0 1-.292.291c-.142.073-.329.073-.702.073h-3.2c-.374 0-.56 0-.703-.073a.667.667 0 0 1-.291-.291c-.073-.143-.073-.33-.073-.703v-5.6z" stroke="#98A2B3" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>                        
                    </span>
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
                    <span class="input-icon">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.667 8.916c2.355.463 4 1.52 4 2.75 0 1.657-2.984 3-6.666 3-3.682 0-6.667-1.343-6.667-3 0-1.23 1.645-2.287 4-2.75m2.667 2.417V6m0 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" stroke="#98A2B3" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>                        
                    </span>
                </div>
            </div>
            @endif
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
