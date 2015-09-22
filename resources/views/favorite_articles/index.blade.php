@extends('app')
@section('content')
    <div class="col-lg-3">
        @include('categories.list_group')
    </div>
    @include('favorite_articles.favorites_list')
@stop