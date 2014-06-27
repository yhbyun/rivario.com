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
<div class="container">

    @include('campaigns._form')

</div>
@stop
