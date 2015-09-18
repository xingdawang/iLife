@extends('app')
@section('content')
    <div class="col-lg-3">
        @include('.categories.list_group')
    </div>
    <div class="col-lg-8">
        <h1>{{ $article->title }}</h1>
        <article>
            {{ $article->body }}
        </article>
    </div>
@stop