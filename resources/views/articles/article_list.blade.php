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
    </ul>
</div>
