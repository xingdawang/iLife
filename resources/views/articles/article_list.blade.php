<div class="col-lg-8">
    <ul class="list-group">
        @foreach($articles as $article)
            <li><h3><a href="{!! url('articles', $article->id) !!}">{!! $article->title !!}</a></h3></li>
        @endforeach
    </ul>
</div>
