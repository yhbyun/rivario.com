@section('scripts')
    <script>
    (function ($) {
        $('.thumb').load(function() {
            $(this).closest('.site').velocity("transition.flipXIn", { stagger: 70 });
        });

        var siteHeader = $('.site-header');
        siteHeader.velocity("fadeIn", { duration: 500 });

        setTimeout(function () {
            $('.site').addClass('ih-item square effect6 from_top_and_bottom');
            $('.site').show();
            $('.site .info').show();
        }, 1200);

    })(jQuery);

    </script>
@stop

@section('content')

<div class="container">
    <header class="site-header">
        <h1>Hi, my name is YongHun Byun and I'm a web developer.</h1>
        <h2>Take a look at some of my projects:</h2>
    </header>

    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default site"><a href="https://rivario.com/bookmark">
                <div class="panel-body">
                <img src="./assets/images/bookmark.png" class="img-responsive thumb img">
                </div>
                <div class="info">
                    <h3>bookmark</h3>
                    <p>Visual bookmark site</p>
                </div></a>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-default site"><a href="https://laravelrocks.com">
                <div class="panel-body">
                <img src="./assets/images/laravelrocks.png" class="img-responsive thumb img">
                </div>
                <div class="info">
                    <h3>laravelrocks</h3>
                    <p>Laravel tips and tricks</p>
                </div>
            </div></a>
        </div>
    </div>
</div>

@stop
