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


    <div class="row disqus">
        <div class="col-xs-12">
            <div id="disqus_thread"></div>
            <script type="text/javascript">
                var disqus_shortname = '{{ Config::get("config.disqus_shortname") }}';

                (function() {
                    var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                    dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                })();
            </script>
            <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
            <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
        </div>
    </div>
</div>

@stop
