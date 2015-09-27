<div class="col-lg-8">
    <ul class="list-group">
        @foreach($articles as $article)
            <li>
                <h3>
                    <a href="{!! url('articles', $article->id) !!}">
                        @foreach($images as $image)
                            @if($image->id  ==  $article->id * 3)
                                {!! Html::image($image->image_url, $article->title)  !!}
                            @endif
                        @endforeach
                        &nbsp;
                        {!! $article->title !!}
                    </a>
                </h3>
            </li>
        @endforeach
        @if($is_manager)
                <a href={!! url('articles/create') !!}><h2><font color="purple">Create a new article</font></h2></a>
            @endif
    </ul>
</div>
