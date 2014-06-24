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
        (function () {
            var myElement = document.querySelector("#gnb");
            // construct an instance of Headroom, passing the element
            var headroom  = new Headroom(myElement,
                {
                    tolerance: 5,
                    offset : 205,
                    classes: {
                        initial: "animated",
                        pinned: "slideDown",
                        unpinned: "slideUp"
                    }
                }
            );
            // initialise
            headroom.init();
        })();

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            }
        });
    </script>
</body>
<!--SWTAGOK--></html>
