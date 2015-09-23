@extends('app')
@section('content')
    <div class="col-lg-3">
        @include('categories.list_group')
    </div>
    <div class="col-lg-8">
        <article>
            <h4>
                @include($content)
                <br />
            </h4>
        </article>

    </div>
@stop