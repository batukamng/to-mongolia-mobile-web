
@if($rows->total() > 0)
        
@else
    <a class="btn btn-light" style="background-color:#088ab2; color:white; border-radius:5px; margin-left:5px;" href="/user/community/create">{{__("동행 찾기")}}</a>
@endif