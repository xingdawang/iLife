{!! Form::open([
    'method'    =>  'DELETE',
    'route'     =>  ['comments.destroy', $comment->id]
]) !!}
<div align="right">
    {!! Form::hidden('article_id', $article->id) !!}
    {!! Form::submit('Delete', ['class' => 'btn btn-primary'], $comment->id) !!}
</div>
{!! Form::close() !!}