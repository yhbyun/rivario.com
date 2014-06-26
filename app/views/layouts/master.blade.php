<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">
    @section('page_title')
    <title>rivario.com</title>
    @show
    @yield('page_desc')
    @yield('page_keywords')
    @if (isset($canonical_url))
    <link rel="canonical" href="{{ $canonical_url }}">
    @endif
    {{ HTML::style(asset('assets/css/main.css?14062201')) }}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('styles')
</head>

<body>
    @include('partials._top')

    <article>
    @yield('content')
    </article>

    @include('partials._footer')


    {{ HTML::script(asset('assets/js/app.js?14062201')) }}
    @yield('scripts')
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', '{{ Config::get("config.analytics_property_id") }}', 'auto');
        ga('send', 'pageview');
    </script>

</body>
<!--SWTAGOK--></html>
