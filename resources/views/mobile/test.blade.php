{!! Form::open([
            'method' => 'POST',
            'route' => 'mobile_get_start_page',
            'class' => 'form-horizontal'
        ]) !!}

    {!! Form::label('id', 'A ID:', ['class'=>'col-lg-3 control-label']) !!}
    {!! Form::text('article_id', null, ['class' => 'form-control']) !!}<br/>
    {!! Form::label('id', 'U ID:', ['class'=>'col-lg-3 control-label']) !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}<br/>
    {!! Form::label('Comment', 'Comment:', ['class'=>'col-lg-3 control-label']) !!}
    {!! Form::text('comment_body', null, ['class' => 'form-control']) !!}<br/>
    {!! Form::label('email', 'email:', ['class'=>'col-lg-3 control-label']) !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}<br/>
    {!! Form::label('name', 'Name:', ['class'=>'col-lg-3 control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}<br/>
    {!! Form::label('password', 'Password:', ['class'=>'col-lg-3 control-label']) !!}
    {!! Form::text('password', null, ['class' => 'form-control']) !!}<br/>
    {!! Form::label('id', 'Launch ID:', ['class'=>'col-lg-3 control-label']) !!}
    {!! Form::text('launch_id', null, ['class' => 'form-control']) !!}<br/>
    {!! Form::submit('Send', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}