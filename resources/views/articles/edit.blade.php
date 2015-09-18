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
            ]) !!}
        @include('articles.article_form')
        {!! Form::close() !!}
    </div>
@stop