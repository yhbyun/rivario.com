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
    {{ HTML::script(asset('assets/js/ghost.js?14062701')) }}
@stop


@section('content')

<xmp class="markdown-editor" style="display:none">

# Contents

- [Validate](/former/validate)


## Example 1

<div class="doc-example">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#example1-preview-tab" data-toggle="tab">Preview</a></li>
        <li><a href="#example1-php-tab" data-toggle="tab">PHP</a></li>
        <li><a href="#example1-html-tab" data-toggle="tab">HTML</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="example1-preview-tab">

{{ Former::framework('TwitterBootstrap3Validator') }}
{{
Former::open_horizontal()
  ->id('MyForm')
  ->secure()
  ->rules(['name' => 'required'])
  ->method('GET')
}}
{{
  Former::text('name')
    ->value('Joseph')
    ->required()
}}
{{
  Former::textarea('comments')
    ->rows(10)->cols(3)
    ->autofocus()
}}
{{
  Former::actions()
    ->lg_primary_submit('Submit')
    ->inverse_reset('Reset')
}}
{{ Former::close() }}

        </div>

        <div class="tab-pane" id="example1-php-tab">


```php
Former::framework('TwitterBootstrap3Validator');

Former::open_horizontal()
  ->id('MyForm')
  ->secure()
  ->rules(['name' => 'required'])
  ->method('GET');

  Former::text('name')
    ->value('Joseph')
    ->required();

  Former::textarea('comments')
    ->rows(10)->cols(3)
    ->autofocus();

  Former::actions()
    ->lg_primary_submit('Submit')
    ->inverse_reset('Reset');

Former::close();
```

        </div>

        <div class="tab-pane" id="example1-html-tab">

```html
<?php
$html = tidyHtml(
Former::framework('TwitterBootstrap3Validator')
  .
Former::open_horizontal()
  ->id('MyForm')
  ->secure()
  ->rules(['name' => 'required'])
  ->method('GET')
  .
  Former::text('name')
    ->value('Joseph')
    ->required()
  .
  Former::textarea('comments')
    ->rows(10)->cols(3)
    ->autofocus()
  .
  Former::actions()
    ->lg_primary_submit('Submit')
    ->inverse_reset('Reset')
  .
Former::close()
);
echo $html;
?>
```

        </div>
    </div>
</div>


-----


## Example 2


<div class="doc-example">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#example2-preview-tab" data-toggle="tab">Preview</a></li>
        <li><a href="#example2-php-tab" data-toggle="tab">PHP</a></li>
        <li><a href="#example2-html-tab" data-toggle="tab">HTML</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="example2-preview-tab">

{{ Former::open_horizontal() }}
{{ Former::legend('Add Success Story') }}
{{ Former::group('BBS Msg ID', ['bbs_msg_id'])
    ->contents('
    <div class="row">
        <div class="col-lg-2">' . Former::text('bbs_msg_id') . '</div>
        <div class="col-lg-6">' . Former::warning_button('Load Success Story')->addClass('ladda-button')->dataStyle('expand-left')->id('btn-load') .
        '</div>
    </div>'
    . (Former::getErrors('bbs_msg_id') ? '<span class="help-block">' . Former::getErrors('bbs_msg_id') . '</span>' : '')
    ) }}
{{ Former\Form\Group::$opened = false }}

{{ Former::group('MemberID', ['member_id'])
    ->contents('
    <div class="row"><div class="col-lg-2">' . Former::text('member_id') . '</div>'
    . (Former::getErrors('member_id') ? '<span class="help-block">' . Former::getErrors('member_id') . '</span>' : '')
    . '</div>'
    ) }}
{{ Former\Form\Group::$opened = false }}

{{ Former::text('thumbnail', 'Image') }}
{{ Former::group('Thumbnail')->contents('<img id="thumbnail_img" src="' . Former::getValue('thumbnail') . '">') }}
{{ Former\Form\Group::$opened = false }}
{{ Former::textarea('abstract', 'Abstract')->rows(2) }}
{{ Former::actions()->lg_primary_submit('Submit') }}

{{ Former::close() }}


        </div>

        <div class="tab-pane" id="example2-php-tab">

```php
Former::open_horizontal();
Former::legend('Add Success Story');

Former::group('BBS Msg ID', ['bbs_msg_id'])
->contents('
<div class="row">
    <div class="col-lg-2">' . Former::text('bbs_msg_id') . '</div>
    <div class="col-lg-6">' . Former::warning_button('Load Success Story')->addClass('ladda-button')->dataStyle('expand-left')->id('btn-load') .
        '</div>
</div>'
. (Former::getErrors('bbs_msg_id') ? '<span class="help-block">' . Former::getErrors('bbs_msg_id') . '</span>' : '')
);
Former\Form\Group::$opened = false;

Former::group('MemberID', ['member_id'])
->contents('
<div class="row"><div class="col-lg-2">' . Former::text('member_id') . '</div>'
    . (Former::getErrors('member_id') ? '<span class="help-block">' . Former::getErrors('member_id') . '</span>' : '')
    . '</div>'
);
Former\Form\Group::$opened = false;

Former::text('thumbnail', 'Image');

Former::group('Thumbnail')->contents('<img id="thumbnail_img" src="' . Former::getValue('thumbnail') . '">');
Former\Form\Group::$opened = false;

Former::textarea('abstract', 'Abstract')->rows(2);
Former::actions()->lg_primary_submit('Submit');

Former::close();
```

        </div>

        <div class="tab-pane" id="example2-html-tab">

```html
<?php
$html =
    Former::open_horizontal()
    .
    Former::legend('Add Success Story')
    .
    Former::group('BBS Msg ID', ['bbs_msg_id'])
    ->contents('
<div class="row">
    <div class="col-lg-2">' . Former::text('bbs_msg_id') . '</div>
    <div class="col-lg-6">' . Former::warning_button('Load Success Story')->addClass('ladda-button')->dataStyle('expand-left')->id('btn-load') .
        '</div>
</div>'
        . (Former::getErrors('bbs_msg_id') ? '<span class="help-block">' . Former::getErrors('bbs_msg_id') . '</span>' : '')
    );

Former\Form\Group::$opened = false;

$html .=
    Former::group('MemberID', ['member_id'])
    ->contents('
    <div class="row"><div class="col-lg-2">' . Former::text('member_id') . '</div>'
    . (Former::getErrors('member_id') ? '<span class="help-block">' . Former::getErrors('member_id') . '</span>' : '')
    . '</div>'
    );

Former\Form\Group::$opened = false;

$html .=
    Former::text('thumbnail', 'Image')
    .
    Former::group('Thumbnail')->contents('<img id="thumbnail_img" src="' . Former::getValue('thumbnail') . '">');

Former\Form\Group::$opened = false;

$html .=
    Former::textarea('abstract', 'Abstract')->rows(2)
    .
    Former::actions()->lg_primary_submit('Submit')
    .
    Former::close();

$html = tidyHtml($html);
echo $html;
?>
```

        </div>
    </div>
</div>

---

## Example 3

<div class="doc-example">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#example3-preview-tab" data-toggle="tab">Preview</a></li>
        <li><a href="#example3-php-tab" data-toggle="tab">PHP</a></li>
        <li><a href="#example3-html-tab" data-toggle="tab">HTML</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="example3-preview-tab">

{{
Former::open_vertical()
->addClass('former-example former-example-form')
}}
{{
Former::email('exampleInputEmail1', 'Email address')
->placeholder('Enter email')
}}
{{
Former::password('exampleInputPassword1', 'Password')
->placeholder('Password')
}}
{{
Former::file('exampleInputFile', 'File Input')
->help('Example block-level help text here.')
}}
{{
Former::default_button('Submit')
->type('submit')
}}
{{ Former::close() }}

        </div>

        <div class="tab-pane" id="example3-php-tab">

```php
Former::open_vertical();
Former::email('exampleInputEmail1', 'Email address')->placeholder('Enter email');
Former::password('exampleInputPassword1', 'Password')->placeholder('Password');
Former::file('exampleInputFile', 'File Input')->help('Example block-level help text here.');
Former::default_button('Submit')->type('submit');
Former::close();
```

        </div>

        <div class="tab-pane" id="example3-html-tab">

```html
<?php
$html = tidyHtml(
Former::open_vertical()
    .
    Former::email('exampleInputEmail1', 'Email address')
        ->placeholder('Enter email')
    .
    Former::password('exampleInputPassword1', 'Password')
        ->placeholder('Password')
    .
    Former::file('exampleInputFile', 'File Input')
        ->help('Example block-level help text here.')
    .
    Former::default_button('Submit')
        ->type('submit')
    .
Former::close()
);
echo $html;
?>
```

        </div>
    </div>
</div>


-----

## Example 4

<div class="doc-example">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#example4-preview-tab" data-toggle="tab">Preview</a></li>
        <li><a href="#example4-php-tab" data-toggle="tab">PHP</a></li>
        <li><a href="#example4-html-tab" data-toggle="tab">HTML</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="example4-preview-tab">

{{
Former::open_inline()
->addClass('former-example former-example-form')
}}
{{
Former::email('exampleInputEmail1', 'Email address')
->placeholder('Enter email')
}}
{{
Former::password('exampleInputPassword1', 'Password')
->placeholder('Password')
}}
<div class="checkbox">
    <label>
        <input type="checkbox"> Remember me
    </label>
</div>
{{
Former::default_button('Sign in')
->type('submit')
}}
{{ Former::close() }}

</div>

<div class="tab-pane" id="example4-php-tab">


```php
{{ "<?php\n" }}
Former::open_inline();
Former::email('exampleInputEmail1', 'Email address')->placeholder('Enter email');
Former::password('exampleInputPassword1', 'Password')->placeholder('Password');
{{ "?>\n" }}

<div class="checkbox">
    <label>
        <input type="checkbox"> Remember me
    </label>
</div>

{{ "<?php\n" }}
Former::default_button('Sign in')->type('submit');
Former::close();
{{ "?>\n" }}
```

</div>

<div class="tab-pane" id="example4-html-tab">

```html
<?php
$html = tidyHtml(
    Former::open_inline()
    .
    Former::email('exampleInputEmail1', 'Email address')
        ->placeholder('Enter email')
    .
    Former::password('exampleInputPassword1', 'Password')
        ->placeholder('Password')
    .
    '
<div class="checkbox">
    <label>
        <input type="checkbox"> Remember me
    </label>
</div>
    '
    .
    Former::default_button('Sign in')
        ->type('submit')
    .
    Former::close()
);
echo $html;
?>
```

        </div>
    </div>
</div>


-----



## Form builders

```php
Former::legend([string])
Former::open()
Former::secure_open()
Former::horizontal_open()
Former::open_for_files()
Former::secure_vertical_open_for_files()
Former::close()
Former::actions([string, ...])
```

```php
// Button class from Bootstrapper
Former::actions( Button::submit('Submit'), Button::reset('Reset') )
```

-----

## Field builders

```php
Former::[classes]_[field]
```

-----

## Former\Field

```php
// Here you're using Former
Former::populate($project)

// Here you're actually using the Field class wrapped in Former
Former::text('foo')
```

```php
Former::text('foo')->class('foo')->foo('bar')
Former::text('foo')->setAttributes(array( 'class' => 'foo', 'foo' => 'bar' ))
```

```php
Former::text('foo')->label([string])
Former::text('foo')->addGroupClass('bar')
```

-----

## Former\Fields\Select

```php
Former::select('foo')->options([array], [selected])
```

#### value로 index를 사용

```php
$clients = array('Mickael', 'Jeseph', 'Patrick');
Former::select('clients')->options($clients, 2)->help('Pick some dude')->state('warning');
```

```html
<?php
$clients = array('Mickael', 'Jeseph', 'Patrick');
$html = tidyHtml(
    Former::select('clients')->options($clients, 2)->help('Pick some dude')->state('warning')
);
echo $html;
?>
```

{{
Former::open()
  ->class('form-horizontal former-example former-example-form')
}}
{{
Former::select('clients')->options($clients, 2)
  ->help('Pick some dude')
  ->state('warning')
}}
{{
Former::close()
}}



#### value와 text를 같이 사용

```php
$clients = array('Mickael', 'Jeseph', 'Patrick');
Former::select('clients')->options($clients, 'Jeseph', true);
```

```html
<?php
$clients = array('Mickael', 'Jeseph', 'Patrick');
$html = tidyHtml(
    Former::select('clients')->options($clients, 'Joseph', true)
);
echo $html;
?>
```

#### value와 text를 따로 사용

```php
$countries = array('KR' => 'Korea', 'CN' => 'China');
Former::select('countries')->options($countries, 'CN');
```

```html
<?php
$countries = array('KR' => 'Korea', 'CN' => 'China');
$html = tidyHtml(
    Former::select('countries')->options($countries, 'CN')
);
echo $html;
?>
```

-----


## Checkboxes and Radios

#### Create a one-off checkbox

```php
// Create a one-off checkbox
Former::checkbox('checkme')
```

```html
{{
tidyHtml(
Former::checkbox('checkme')
)
}}
```

{{ Former::open()->class('form-horizontal former-example former-example-form') }}
{{ Former::checkbox('checkme') }}
{{ Former::close() }}


#### Create a one-off checkbox with a text, and check it

```php
// Create a one-off checkbox with a text, and check it
Former::checkbox('checkme')
  ->text('YO CHECK THIS OUT')
  ->check()
```

```html
{{
tidyHtml(
Former::checkbox('checkme')
  ->text('YO CHECK THIS OUT')
  ->check()
)
}}
```

{{ Former::open()->class('form-horizontal former-example former-example-form') }}
{{
Former::checkbox('checkme')
  ->text('YO CHECK THIS OUT')
  ->check()
}}
{{ Former::close() }}



#### Create four related checkboxes

```php
// Create four related checkboxes
Former::checkboxes('checkme')
  ->checkboxes('first', 'second', 'third', 'fourth');
```

```html
<?php
$html = tidyHtml(
    Former::checkboxes('checkme')
        ->checkboxes('first', 'second', 'third', 'fourth')
);
echo $html;
?>
```

{{ Former::horizontal_open()->class('form-horizontal former-example former-example-form') }}
{{
Former::checkboxes('checkme')
  ->checkboxes('first', 'second', 'third', 'fourth')
}}
{{ Former::close() }}


#### Create related checkboxes, and inline them

```php
// Create related checkboxes, and inline them
$checkboxes = array('first', 'second', 'third', 'fourth');
Former::checkboxes('checkme')
  ->checkboxes($checkboxes)->inline();
```

```html
<?php
$checkboxes = array('first', 'second', 'third', 'fourth');
$html = tidyHtml(
Former::checkboxes('checkme')
  ->checkboxes($checkboxes)->inline()
);
echo $html;
?>
```

{{ Former::open()->class('form-horizontal former-example former-example-form') }}
{{
Former::checkboxes('checkme')
  ->checkboxes($checkboxes)->inline()
}}
{{ Former::close() }}


#### Everything that works on a checkbox also works on a radio element

```php
// Everything that works on a checkbox also works on a radio element
Former::radios('radio')
  ->radios(array('label' => 'name', 'label' => 'name'))
  ->stacked();
```

```html
<?php
$html = tidyHtml(
Former::radios('radio')
  ->radios(array('label' => 'name', 'label' => 'name'))
  ->stacked()
);
echo $html;
?>
```

{{ Former::open()->class('form-horizontal former-example former-example-form') }}
{{
Former::radios('radio')
  ->radios(array('label' => 'name', 'label' => 'name'))
  ->stacked()
}}
{{ Former::close() }}


#### Stacked and inline can also be called as magic methods

```php
// Stacked and inline can also be called as magic methods
Former::inline_checkboxes('foo')->checkboxes('foo', 'bar');
Former::stacked_radios('foo')->radios('foo', 'bar');
```

```html
<?php
$html = tidyHtml(
Former::inline_checkboxes('foo')->checkboxes('foo', 'bar') .
    Former::stacked_radios('foo')->radios('foo', 'bar')
);
echo $html;
?>
```

{{ Former::open()->class('form-horizontal former-example former-example-form') }}
{{ Former::inline_checkboxes('foo')->checkboxes('foo', 'bar') }}
{{ Former::stacked_radios('foo')->radios('foo', 'bar') }}
{{ Former::close() }}


#### Set which checkables are checked or not in one move

```php
// Set which checkables are checked or not in one move
former::checkboxes('level')
  ->checkboxes(0, 1, 2)
  ->check(array('level_0' => true, 'level_1' => false, 'level_2' => true));
```

```html
<?php
$html = tidyHtml(
former::checkboxes('level')
  ->checkboxes(0, 1, 2)
  ->check(array('level_0' => true, 'level_1' => false, 'level_2' => true))
);
echo $html;
?>
```

{{ Former::open()->class('form-horizontal former-example former-example-form') }}
{{
former::checkboxes('level')
  ->checkboxes(0, 1, 2)
  ->check(array('level_0' => true, 'level_1' => false, 'level_2' => true))
}}
{{ Former::close() }}


#### Fine tune checkable elements

```php
// Fine tune checkable elements
Former::radios('radio')
  ->radios(array(
    'label' => array('name' => 'foo', 'value' => 'bar', 'data-foo' => 'bar'),
    'label' => array('name' => 'foo', 'value' => 'bar', 'data-foo' => 'bar'),
  ));
```

```html
<?php
$html = tidyHtml(
Former::radios('radio')
  ->radios(array(
    'label' => array('name' => 'foo', 'value' => 'bar', 'data-foo' => 'bar'),
    'label' => array('name' => 'foo', 'value' => 'bar', 'data-foo' => 'bar'),
  ))
);
echo $html;
?>
```

{{ Former::open()->class('form-horizontal former-example former-example-form') }}
{{
Former::radios('radio')
  ->radios(array(
    'label' => array('name' => 'foo', 'value' => 'bar', 'data-foo' => 'bar'),
    'label' => array('name' => 'foo', 'value' => 'bar', 'data-foo' => 'bar'),
  ))
}}
{{ Former::close() }}

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
