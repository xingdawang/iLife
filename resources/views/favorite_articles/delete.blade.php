{!! Form::open([
            'method' => 'DELETE',
            'route' => ['favorite_articles.destroy', $favorite_article->article_id]
        ]) !!}
<div align="right">
    {!! Form::submit('Delete', ['class' => 'btn btn-primary'], $favorite_article->id) !!}
</div>
{!! Form::close() !!}