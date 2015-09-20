@extends('app')
@section('content')
    <div class="col-lg-3">
        @include('.categories.list_group')
    </div>
    <div class="col-lg-8">
        {!! Form::open(['url'=>'articles', 'class'=>'form-horizontal', 'files'=>true]) !!}
            @include('articles.article_form')
        {!! Form::close() !!}
    </div>
@stop