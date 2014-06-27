@section('styles')
<style>
    #frm-html {margin-bottom:20px}
</style>
@stop


@section('content')

<div class="container">
    <div class="row">
        <h1>CSS Inliner Tool</h1>
<?php
$url = URL::action('CampaignsController@postInline');
Input::replace(array('html' => ''));
?>
{{ Former::framework('TwitterBootstrap3Validator') }}
{{
Former::open_vertical($url)
->id('frm-html')
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

<?php
Former::populateField('inlinehtml', $inlineHtml);
?>

<div class="alert alert-success">
Below is your code with all of your CSS inlined for proper rendering in email clients.</div>

{{
Former::open_vertical($url)
->method('POST')
}}

{{
Former::textarea('inlinehtml')
->rows(20)
}}

{{ Former::close() }}

<iframe srcdoc="{{{ $inlineHtml }}}" width="100%" height="500px">
</iframe>

    </div>
</div>

@stop

