@extends ('layouts.app')
@section ('content')
    @if($row->template_id)
        <div class="page-template-content">
            {!! $row->getProcessedContent() !!}
        </div>
    @else
        <div class="container">
            <h1>{!! clean($translation->title) !!}</h1>
            <div class="blog-content">
                {!! $translation->content !!}
            </div>
        </div>
    @endif
@endsection
