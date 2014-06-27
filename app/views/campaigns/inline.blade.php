<?php
$page_title = "CSS Inliner Tool - rivario.com";
?>

@include('partials._page-title')

@section('styles')
<style>
form {margin-bottom:20px}
input[type=checkbox] {
    margin-left:0px!important;
    margin-right:10px!important;
}
</style>
@stop


@section('content')

<?php
Input::merge(array('html' => ''));
?>

<div class="container">

    @include('campaigns._form')

    <div class="row">

<?php
Former::populateField('inline', $inlineHtml);
?>

<div class="alert alert-success">
Below is your code with all of your CSS inlined for proper rendering in email clients.
</div>

{{
    Former::open_vertical()
        ->method('POST')
}}

{{
    Former::textarea('inline')
        ->label('')
        ->rows(20)
}}

{{
    Former::close()
}}

<iframe srcdoc="{{{ $inlineHtml }}}" width="100%" height="500px">
</iframe>

    </div>
</div>

@stop

