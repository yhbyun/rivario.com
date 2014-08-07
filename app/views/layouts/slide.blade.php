<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta charset="utf-8">

    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <meta property="og:title" content="@yield('title') &middot; rivario.com" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ URL::current() }}" />
    <meta property="og:image" content="@yield('image')" />
    <meta property="og:site_name" content="rivario.com" />
    <meta property="og:description" content="@yield('description')" />
    <meta name="description" content="@yield('description')">
    <title>@yield('title') | rivario.com</title>
    <meta name="author" content="YongHun Byun, @river">
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="author" href="https://plus.google.com/+YongHunByun"/>

    {{ HTML::style(asset('assets/components/reveal.js/css/reveal.min.css')) }}
    {{ HTML::style(asset('assets/components/reveal.js/css/theme/river.css'), ['id' => 'theme']) }}
    {{ HTML::style(asset('assets/components/reveal.js/lib/css/zenburn.css')) }}
    <link rel="stylesheet" href="http://static1.ecplaza.com/css/font.css" >
    {{ HTML::style(asset('assets/components/reveal.js/plugin/spotlight/spotlight.css')) }}

    <!-- If the query includes 'print-pdf', include the PDF print sheet -->
    <script>
        if( window.location.search.match( /print-pdf/gi ) ) {
            var link = document.createElement( 'link' );
            link.rel = 'stylesheet';
            link.type = 'text/css';
            link.href = '{{ asset('assets') }}/components/reveal.js/css/print/pdf.css';
            document.getElementsByTagName( 'head' )[0].appendChild( link );
        }
    </script>

    <!--[if lt IE 9]>
    <script src="{{ asset('assets') }}/components/reveal.js/lib/js/html5shiv.js"></script>
    <![endif]-->

    @yield('styles')
</head>

<body>
    <div class="reveal">
        <div class="slides">
            @yield('content')
        </div>
    </div>

    {{ HTML::script(asset('assets/components/reveal.js/lib/js/head.min.js')) }}
    {{ HTML::script(asset('assets/components/reveal.js/js/reveal.min.js')) }}

    <script>

    // Full list of configuration options available here:
    // https://github.com/hakimel/reveal.js#configuration
    Reveal.initialize({
        controls: false,
        progress: true,
        history: true,
        center: true,

        theme: Reveal.getQueryHash().theme, // available themes are in /css/theme
        transition: Reveal.getQueryHash().transition || 'fade', // default/cube/page/concave/zoom/linear/fade/none

        // Parallax scrolling
        // parallaxBackgroundImage: 'https://s3.amazonaws.com/hakim-static/reveal-js/reveal-parallax-1.jpg',
        // parallaxBackgroundSize: '2100px 900px',

        // Optional libraries used to extend on reveal.js
        dependencies: [
            { src: '{{ asset('assets') }}/components/reveal.js/lib/js/classList.js', condition: function() { return !document.body.classList; } },
            { src: '{{ asset('assets') }}/components/reveal.js/plugin/markdown/marked.js', condition: function() { return !!document.querySelector( '[data-markdown]' ); } },
            { src: '{{ asset('assets') }}/components/reveal.js/plugin/markdown/markdown.js', condition: function() { return !!document.querySelector( '[data-markdown]' ); } },
            { src: '{{ asset('assets') }}/components/reveal.js/plugin/highlight/highlight.js', async: true, callback: function() { hljs.initHighlightingOnLoad(); } },
            { src: '{{ asset('assets') }}/components/reveal.js/plugin/spotlight/spotlight.js', async: true, callback: function() { return !!document.body.classList; } },
            { src: '{{ asset('assets') }}/components/reveal.js/plugin/zoom-js/zoom.js', async: true, condition: function() { return !!document.body.classList; } },
            { src: '{{ asset('assets') }}/components/reveal.js/plugin/notes/notes.js', async: true, condition: function() { return !!document.body.classList; } }
        ]
    });
    </script>
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
