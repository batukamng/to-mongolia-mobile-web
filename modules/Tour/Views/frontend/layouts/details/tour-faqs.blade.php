@if($translation->faqs)
    <div class="g-faq">
        <h3> {{__("Extra Information")}} </h3>
        @foreach($translation->faqs as $item)
            <div class="item">
                <div class="header">
                    <i class="field-icon icofont-support-faq"></i>
                    <h5>{{$item['title']}}</h5>
                    <span class="arrow"><i class="fa fa-angle-down"></i></span>
                </div>
                <div class="body">
                    {!! clean($item['content']) !!}
                </div>
            </div>
        @endforeach
    </div>
@endif