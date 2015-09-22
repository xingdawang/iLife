<div class="col-lg-8">
    <ul class="list-group">
        @foreach ($favorites_list as $favorite_article)
            <li class="list-group-item">
                <a href=" {!! url('/articles', $favorite_article->article_id) !!}">{!! $favorite_article->title !!}</a>
                @include('favorite_articles.delete')
            </li>
        @endforeach
    </ul>
</div>
</div>