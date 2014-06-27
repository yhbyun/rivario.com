@section('scripts')
<script>
jQuery(function ($) {
    $('#frm-inliner').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            html: {
                validators: {
                    notEmpty: {
                        message: 'The html is required'
                    }
                }
            }
        }
    });
});
</script>
@stop

<div class="row">
    <h1>CSS Inliner Tool</h1>

    <div class="well">
    This tool converts CSS rules into inline style
    </div>

    {{ Former::framework('TwitterBootstrap3Validator') }}
    {{ Former::open_vertical()->id('frm-inliner')->action(URL::action('CampaignsController@postInline')) }}
    {{ Former::textarea('html')->label('')->rows(20)->placeholder('Place your HTML here to convert') }}
    {{ Former::checkbox('stripOriginCSS')->label('')->text('Strip original &lt;style&gt; tags?') }}
    {{ Former::actions()->lg_primary_submit('Convert') }}
    {{ Former::close() }}
</div>
