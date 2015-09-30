@extends('app')
@section('content')
    <div class="col-lg-3">
        @include('.categories.list_group')
    </div>
    <div class="col-lg-8">
        {!! Form::model(
            $article,
            [
                'method'=>'PATCH',
                'class'=>'form-horizontal',
                'action'=>['ArticlesController@update', $article->id],
                'files'=>true,
            ]) !!}
        @include('articles.article_form')
        {!! Form::close() !!}
        <hr>
        {!! Form::open([
            'method' => 'DELETE',
            'action' => ['ArticlesController@destroy', $article->id]
        ]) !!}
        <div align="right">
            {!! Form::submit('Delete', ['class' => 'btn btn-primary'], $article->id) !!}
        </div>
        {!! Form::close() !!}
    </div>
@stop