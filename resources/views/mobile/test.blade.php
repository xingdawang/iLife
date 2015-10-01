{!! Form::open([
            'method' => 'POST',
            'route' => 'mobile_article_details',
            'class' => 'form-horizontal'
        ]) !!}

    {!! Form::label('id', 'ID:', ['class'=>'col-lg-3 control-label']) !!}
    {!! Form::text('article_id', null, ['class' => 'form-control']) !!}<br/>
    {!! Form::label('email', 'email:', ['class'=>'col-lg-3 control-label']) !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}<br/>
    {!! Form::label('name', 'Name:', ['class'=>'col-lg-3 control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}<br/>
    {!! Form::label('password', 'Password:', ['class'=>'col-lg-3 control-label']) !!}
    {!! Form::text('password', null, ['class' => 'form-control']) !!}<br/>
    {!! Form::submit('Send', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}