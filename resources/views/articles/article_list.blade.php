<div class="col-lg-8">
    <ul class="list-group">
        <!-- Detect whether there is an no top list -->
        <?php
            foreach($articles as $article)
                if($article->is_top){
                    echo '<h3><font color="red">TOP ARTICLES!</font></h3>';
                    break;
                }
        ?>

        <!-- Get top articles list -->
        @foreach($articles as $article)
            @if($article->is_top)
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
            @endif
        @endforeach

         <?php
            foreach($articles as $article)
                if($article->is_top){
                    echo '<hr />';
                    break;
                }
         ?>

         <!-- Get common articles list -->
         @foreach($articles as $article)
            @if(!$article->is_top)
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
            @endif
        @endforeach
        @if($is_manager)
                <a href={!! url('articles/create') !!}><h2><font color="purple">Create a new article</font></h2></a>
            @endif
    </ul>
</div>
