@extends('app')
@section('content')
    <div class="col-lg-3">
        @include('.categories.list_group')
    </div>
    <div class="col-lg-8">
        {!! Html::image($images[0]->image_url, $article->title)  !!}
        <h1>
            {!! $article->title  !!}
            @include('favorite_articles.store')
        </h1>

        <article>
            @if($is_manager)
                <a href={!! url('articles/'. $article->id.'/edit') !!}>
                    <h3><font color="red">Edit</font></h3>
                </a>
            @endif
            <hr />
            <h4>
                {!! nl2br($article->body) !!}
                <br />
                <hr />
                {!! Html::image($images[1]->image_url, $article->title)  !!}
            </h4>
        </article>
        <hr />
        @include('comments.show')
        @include('comments.create')
    </div>

@stop