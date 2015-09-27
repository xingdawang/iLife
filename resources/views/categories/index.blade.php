@extends('app')
@section('content')
    <div class="col-lg-3">
        @include('categories.list_group')
        @if($is_manager)
            @include('categories.add_list_group')
        @endif
    </div>
    <div class="col-lg-8">
        @include('sliders.index')
    </div>
@stop