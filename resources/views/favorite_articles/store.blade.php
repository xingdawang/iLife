{!! Form::open(['url'=>'favorite_articles', 'class'=>'form-horizontal', 'files'=>true]) !!}
<div align="right">
    {!! Form::hidden('article_id', $article->id) !!}
    {!! Form::submit('Add Favorite', ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::close() !!}