{!! Form::open([
            'method' => 'POST',
            'route' => 'mobile_articles_get_article',
            'class' => 'form-horizontal'
        ]) !!}

    {!! Form::label('id', 'ID:', ['class'=>'col-lg-3 control-label']) !!}
    {!! Form::text('id', null, ['class' => 'form-control']) !!}
    {!! Form::submit('Send', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}