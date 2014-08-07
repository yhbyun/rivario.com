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
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-desktop"></i> Laravel <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="https://laravelrocks.com">laravelrocks.com</a></li>
                        <li><a href="{{ str_replace('/index', '', action('EloquentController@getIndex')) }}">Eloquent Test</a></li>
                        <li><a href="https://github.com/yhbyun/laravel-snowman">Laravel-snowman <span class="label label-warning">New</span></a></li>
                        <li class="divider"></li>
                        <li><a href="http://cheats.jesse-obrien.ca/">Laravel Cheat Sheet</a></li>
                        {{--
                        <li><a href="{{ str_replace('/index', '', action('FormerController@getIndex')) }}">Former</a></li>
                        --}}
                    </ul>
                </li>
                <li><a href="/bookmark"><i class="fa fa-bookmark"></i> Bookmark</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-magic"></i> Tools/Libs <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ str_replace('/index', '', action('CampaignsController@getIndex')) }}">CSS Inliner Tool</a></li>
                        <li><a href="{{ route('endpage.index') }}">jQuery End Page Plugin</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-sliders"></i> Slide <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="http://www.slideshare.net/yhbyun/ss-24634455">Bookmark 서비스 개발기</a></li>
                        <li><a href="http://www.slideshare.net/yhbyun/ss-31563706">대량메일 발송하기</a></li>
                        <li><a href="http://www.slideshare.net/yhbyun/ss-31468926">siri 흉내내기</a></li>
                        <li><a href="{{ route('slide.gulp') }}">Gulp</a></li>
                        <li><a href="{{ route('slide.atom-shell') }}">Atom-Shell / Alarm Clock <span class="label label-warning">New</span></a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cubes"></i> Blog <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="http://ghost.rivario.com"><i class="fa fa-terminal"></i> Red Ghost</a></li>
                        <li><a href="http://river.ecplaza.net"><i class="fa fa-leaf"></i> Personal Blog</a></li>
                    </ul>
                </li>
                <li><a href="http://about.me/yhbyun"><i class="fa fa-question-circle"></i> About</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>
