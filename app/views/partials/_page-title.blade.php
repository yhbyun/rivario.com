@if (isset($page_title))
    @section('page_title')
        <title>{{{ $page_title }}}</title>
@stop
@endif

@if (isset($page_desc))
    @section('page_desc')
        <meta name="description" content="{{{ $page_desc }}}">
    @stop
@endif

@if (isset($page_keywords))
    @section('page_keywords')
        <meta name="keywords" content="{{{ $page_keywords }}}">
    @stop
@endif
