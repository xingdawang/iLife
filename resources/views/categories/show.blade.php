@extends('.app')
@section('content')
    <div class="col-lg-3">
        @include('.categories.list_group')
    </div>
    @include('articles.article_list')
@stop