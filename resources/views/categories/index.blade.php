@extends('app')
@section('content')
    <div class="col-lg-3">
        @include('categories.list_group')
        @include('categories.add_list_group')
    </div>
@stop