<div id="gnb" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">rivario.com</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">Home</a></li>
                <li><a href="http://ghost.rivario.com"><i class="fa fa-leaf"></i> Ghost Blog</a></li>
                <li><a href="http://river.ecplaza.net"><i class="fa fa-leaf"></i> Blog</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-desktop"></i> Laravel <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="https://laravelrocks.com">laravelrocks.com</a></li>
                        <li><a href="{{ str_replace('/index', '', action('EloquentController@getIndex')) }}">Eloquent Test</a></li>
                        {{--
                        <li><a href="{{ str_replace('/index', '', action('FormerController@getIndex')) }}">Former</a></li>
                        --}}
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-magic"></i> Tools <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ str_replace('/index', '', action('CampaignsController@getIndex')) }}">CSS Inliner Tool</a></li>
                    </ul>
                </li>
                <li><a href="http://about.me/yhbyun"><i class="fa fa-question-circle"></i> About</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>
