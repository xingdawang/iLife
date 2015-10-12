{!! Form::open([
            'method' => 'POST',
            'route' => 'mobile_get_category_articles',
            'class' => 'form-horizontal'
        ]) !!}

    {!! Form::label('id', 'Article ID:', ['class'=>'col-lg-3 control-label']) !!}
    {!! Form::text('article_id', null, ['class' => 'form-control']) !!}<br/>
    {!! Form::label('id', 'Category ID:', ['class'=>'col-lg-3 control-label']) !!}
    {!! Form::text('category_id', null, ['class' => 'form-control']) !!}<br/>
    {!! Form::label('id', 'User ID:', ['class'=>'col-lg-3 control-label']) !!}
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