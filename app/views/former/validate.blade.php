@section('title', 'Former Example')

@section('styles')
<style>
    .doc-example .tab-content > .active {
        border: 1px solid #ddd;
        border-top: none;
        border-bottom-left-radius: 4px;
        border-bottom-right-radius: 4px;
    }
    .doc-example .tab-pane {
        padding:10px 15px;
        background-color: #fff;
    }
    .doc-example pre {
        border:0;
        margin:0;
        padding:0;
        background-color: #fff;
    }
    .doc-example pre code {
        background-color: #fff;
    }
</style>
@stop

@section('scripts')
<script>
jQuery(function ($) {
    $('#frm-test').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'The username is required'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email is required'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            }
        }
    });
});
</script>
@stop


@section('content')

<xmp class="markdown-editor" style="display:none">

# Validate

`bootstrapvalidator`를 이용, client 쪽, server 쪽 validation을 동시에 사용할 수 있다.
`bootstrapvalidaor`와 같이 쓰기 위해서는 `former`를 다음의 버전으로 사용해야 한다.

```javascript
"repositories": [
    {
    "type": "vcs",
    "url": "https://github.com/yhbyun/former.git"
    }
],
"require": {
    "anahkiasen/former": "dev-bootstrapvalidator"
},
```

## Example 1

<div class="doc-example">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#validate-preview-tab" data-toggle="tab">Preview</a></li>
        <li><a href="#validate-php-tab" data-toggle="tab">PHP</a></li>
        <li><a href="#validate-js-tab" data-toggle="tab">JS</a></li>
        <li><a href="#validate-html-tab" data-toggle="tab">결과 HTML</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="validate-preview-tab">

{{ Former::framework('TwitterBootstrap3Validator') }}
{{
Former::open_horizontal()
->addClass('former-example former-example-form')
->id('frm-test')
->method('POST')
}}
{{
Former::text('name', 'Your Full Name')
    ->placeholder('Enter name')
    ->required()
}}
{{
Former::email('email', 'Email Address')
    ->placeholder('Enter email')
    ->required()
}}
{{
Former::textarea('comments')
    ->rows(3)
    ->required()
}}
{{
Former::actions()
->primary_submit('Submit')
}}
{{ Former::close() }}


        </div>

        <div class="tab-pane" id="validate-php-tab">


```php
Former::framework('TwitterBootstrap3Validator');

Former::open_horizontal()
    ->id('form-test')
    ->method('POST');

Former::text('name', 'Your Full Name')
    ->placeholder('Enter name')
    ->required();

Former::email('email', 'Email Address')
    ->placeholder('Enter email')
    ->required():

Former::textarea('comments')
    ->rows(3)
    ->required();

Former::actions()
    ->primary_submit('Submit')

Former::close();
```

        </div>

        <div class="tab-pane" id="validate-html-tab">

```html
<?php
$html = tidyHtml(
    Former::framework('TwitterBootstrap3')
    .
    Former::open_horizontal()
        ->id('form-test')
        ->method('POST')
    .
    Former::text('name', 'Your Full Name')
        ->placeholder('Enter name')
        ->required()
    .
    Former::email('email', 'Email Address')
        ->placeholder('Enter email')
        ->required()
    .
    Former::textarea('comments')
        ->rows(3)
        ->required()
    .
    Former::actions()
        ->primary_submit('Submit')
    .
    Former::close()
);
echo $html;
?>
```

        </div>

        <div class="tab-pane" id="validate-js-tab">
```javascript
jQuery(function ($) {
    $('#frm-test').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'The username is required'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email is required'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            }
        }
    });
});
```
        </div>
    </div>
</div>


</xmp>

<div class="container">
    <div class="rendered-markdown"></div>
</div>

<?php
function tidyHtml($html)
{
    return trim(htmLawed($html, array('tidy' => '2'))) . "\n";
}
?>
@stop
