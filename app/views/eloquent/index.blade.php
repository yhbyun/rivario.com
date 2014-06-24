<?php
$page_title = "Laravel Eloquent Test - rivario.com";
?>

@include('partials._page-title')

@section('styles')
<style>
    .code {
        background-color: #fff;
        border:1px solid #ddd;
        border-radius: 4px 4px 0 0;
        box-shadow: none;
        padding: 15px;
    }
    .sql {
        padding: 9px 14px;
        margin-bottom: 14px;
        background-color: #f7f7f9;
        border: 1px solid #e1e1e8;
        border-radius: 4px
    }
    .code+.sql {
        border-radius: 0;
        border-width: 0 0 1px
    }
    .code+.sql {
        margin: -5px 0 0px;
        border-width: 1px;
        border-bottom-left-radius: 4px;
        border-bottom-right-radius: 4px
    }

    .error {
        color:#f00;
        font-weight: bold;
    }

    .form-wrapper {
        margin-bottom: 20px;
    }

    #results .result:first-child {
        border:2px dashed #f0ad4e;
    }

    #results-demo {
        overflow: scroll;
        margin-top:20px;
    }

    .result {
        margin-bottom:15px;
    }

    #id-form textarea {
        padding:10px;
        font-size:16px;
    }

    /* css transition */
    /*
    http://timtaubert.de/blog/2012/09/css-transitions-for-dynamically-created-dom-elements/
    http://stackoverflow.com/questions/12814612/css3-transition-to-highlight-new-elements-created-in-jquery
    */
    .result, .code, .sql {
        /*
        -moz-transition:background-color 1s;
        -webkit-transition:background-color 1s;
        -o-transition:background-color 1s;
        transition:background-color 1s;
        */
        transition: opacity 500ms;
    }
    /*
    .result.new, .result.new .code, .result.new .sql {
        background-color:#f0ad4e;
    }
    */
    .result.new {
        opacity: 0;
    }
</style>
@stop

@section('scripts')
<script>
    jQuery(function ($) {
        $('#form-submit').click(function (e) {
            e.preventDefault();
            var l = Ladda.create(this);
            l.start();

            var promise = $.ajax({
                url: '{{ URL::current() }}/exec',
                data: $('#id-form').serializeArray(),
                method: 'post',
                dataType: 'json'
            });

            var presenter = new Presenter();

            promise.then(function (data) {
                presenter.addResult(data[0]);
            }).fail(function () {
                var data = {code:$('#id-form textarea').val(), sql:'<span class="label label-danger">500 Internal Server Error<\/span>'};
                presenter.addResult(data);
            }).always(function () {
                l.stop();
            });

        });

        var window_height = $(window).height(),
            content_height = window_height - 200;
        $('#results-demo').height(content_height);
    });

    function Presenter() {
        var source = $('#tpl-result').html();
        this.template = Handlebars.compile(source);
        Handlebars.registerHelper('json', function(obj) {
            return JSON.stringify(obj, null, 2);
        });
    };
    Presenter.prototype.addResult = function (data) {
        var html = this.template(data);
        $('#results').prepend(html);
        var $result = $('#results .result:first-child');
        $result.focus();
        $result.removeClass('new');

        $('pre code').each(function(i, block) {
            hljs.highlightBlock(block);
        });
    }

</script>
<script id="tpl-result" type="text/x-handlebars-template">
    <div class="result new">
        <div class="code">@{{ code }}</div>
        <div class="sql">
            <ul>
            @{{#sql}}
                <li>@{{&.}}</li>
            @{{/sql}}
            </ul>
        </div>
        @{{#if data}}
        <pre class="code"><code class="json">@{{json data}}</code></pre>
        @{{/if}}
    </div>
</script>
@stop

@section('content')

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h1>Eloquent Test</h1>
            <div class="well">This tool helps <code>Laravel</code> developers learn <code>Eloquent ORM</code>.
                Enter the Eloquent code in the box below and you will get the generated SQL queries and result data.</div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">Sample Table</div>
                <div class="panel-body">
<img src="/assets/images/author-erd.png" class="img-responsive" />
<img src="/assets/images/lesson-erd.png" class="img-responsive" />
<img src="/assets/images/poly-erd.png" class="img-responsive" />
                </div>
            </div>

        <h4>Example Code</h4>

<?php
// 다음 코드는 동일
$runner->evalCode("Author::find(1)->posts;");
$runner->evalCode("Author::find(1)->posts()->get();");

// 세 가지는 같은 코드
$runner->evalCode("Post::where('title', '=', 'My First Post')->first();");
$runner->evalCode("Post::where('title', 'My First Post')->first();");
$runner->evalCode("Post::whereTitle('My First Post')->first();");
$runner->evalCode("Post::whereTitle('My First Post')->get();");

// 두 가지를 비교해 봐라.
$runner->evalCode("Author::find(1)->posts;");
$runner->evalCode("Author::with('posts')->find(1);");

$code = <<<'EOF'
Author::with(['posts' => function ($query) {
    $query->where('title', 'My First Post')->select('title', 'body')->orderBy('created_at', 'DESC');
}])->find(1);
EOF;

$runner->evalCode($code);

$runner->evalCode("Lesson::find(1)->tags;");

$code = <<<'EOF'
Tag::join('lesson_tag', 'lesson_tag.tag_id', '=', 'tags.id')
    ->groupBy('tags.name')
    ->get(['tags.name', DB::raw('count(*) as lessons_count')]);
EOF;

$runner->evalCode($code);


// eager loading

$code = <<<'EOF'
$posts = Post::whereAuthorId(1)->get();
foreach ($posts as $post) {
    $name = $post->author->name;
}
EOF;

$runner->evalCode($code);

$code = <<<'EOF'
$posts = Post::with('author')->whereAuthorId(1)->get();
foreach ($posts as $post) {
    $name = $post->author->name;
}
EOF;

$runner->evalCode($code);

// 주의해야 할 방법들
$runner->evalCode("Author::find(1)->posts->count();");
$runner->evalCode("Author::find(1)->posts()->count();");
$runner->evalCode("Author::find(1)->posts()->get()->count();");

// 동일
$runner->evalCode("Post::orderBy('created_at', 'DESC')->get();");
$runner->evalCode("Post::latest()->get();");

$runner->evalCode("Post::orderBy('created_at', 'ASC')->get();");
$runner->evalCode("Post::oldest()->get();");

// Polymorphic Relations ---------------------------------

$runner->evalCode("Post::find(1)->seo->first();");
$runner->evalCode("Post::with('seo')->find(1);");

$runner->evalCode("Seo::find(1)->seoable;");
$runner->evalCode("Seo::with('seoable')->get();");

$results = $runner->getResult();
?>

<div id="results-demo" class="well">
@foreach ($results as $result)
    <div class="result">
        <div class="code">{{ $result['code'] }}</div>
        <div class="sql">
            <ul>
        @foreach ($result['sql'] as $sql)
            <li>{{ $sql }}</li>
        @endforeach
            </ul>
        </div>
    </div>
@endforeach
</div>

        </div>
        <div class="col-xs-12 col-sm-6">

            <div class="row form-wrapper">
                {{ Form::open(['id' => 'id-form']) }}
                <div class="col-xs-9">
                {{ Form::textarea('code', '', ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Enter code']) }}
                </div>
                <div class="col-xs-3 nopadding">
                <a href="#" id="form-submit" class="btn btn-primary btn-lg ladda-button" data-style="expand-left" data-size="l">Execute</a>
                </div>
                {{ Form::close() }}
            </div>

            <div class="row">
                <div id="results" class="col-xs-12">

                </div>
            </div>
        </div>
    </div>
</div>

@stop
