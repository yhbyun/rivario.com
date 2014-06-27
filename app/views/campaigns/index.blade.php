
@section('content')
<div class="container">
    <div class="row">
        <h1>CSS Inliner Tool</h1>

<?php $url = URL::action('CampaignsController@postInline'); ?>
{{ Former::framework('TwitterBootstrap3Validator') }}
{{
Former::open_vertical($url)
->method('POST')
}}

{{
Former::textarea('html')
->rows(20)
->placeholder('Place your HTML here to convert');
}}

{{
Former::actions()
->lg_primary_submit('Convert')
}}

{{ Former::close() }}

    </div>
</div>

@stop
