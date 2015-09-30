<div class="col-lg-8">
    <ul class="list-group">

        <!-- Detect whether there is a top list -->
        <?php

            // Save state for all most top articles
            $flag = false;

            // Check for this category top articles
            foreach($articles as $article)
                if($article->is_top){
                    echo '<h3><font color="red">TOP ARTICLES!</font></h3>';
                    $flag = true;
                    break;
                }

            if(!$flag && sizeof($top_list_articles) != 0)
                echo '<h3><font color="red">TOP ARTICLES!</font></h3>';
        ?>

        <!-- Get all categories top articles list -->
        @if($top_list_articles != null)
            @foreach($top_list_articles as $article)
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
        @endif
        <!-- Get this category top articles list -->
            @foreach($articles as $article)
                @if($article->is_top == 1)
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


        <!-- Detect whether there is a top list -->
            <?php

                // Save state for all most top articles
                $flag = false;

                // Check for this category top articles
                foreach($articles as $article)
                      if($article->is_top){
                           echo '<hr />';
                           $flag = true;
                            break;
                      }

                if(!$flag && sizeof($top_list_articles) != 0)
                    echo '<hr />';
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
