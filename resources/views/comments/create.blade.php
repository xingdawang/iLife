{!! Form::open(['url' => 'comments', 'class' => 'form-horizontal']) !!}
<fieldset>
    <div class="form-group">
        {!! Form::label('Comment', null, ['class' => 'col-lg-1 control-label']) !!}
        <div class="col-lg-11">
            {!! Form::textArea('body', null, ['class' => 'form-control', 'rows' => '4',
                'id' => 'textArea', 'placeholder' => 'Love to say something?']) !!}
            {!! Form::hidden('article_id', $article->id) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-11 col-lg-offset-5">
            {!! Form::button('Cancel', ['type' => 'reset', 'class' => 'btn btn-default']) !!}
            {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
</fieldset>

<div style="height: 100px">
</div>
{!! Form::close() !!}
