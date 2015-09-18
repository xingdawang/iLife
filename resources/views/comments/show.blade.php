@if($comments != null)
    @foreach($comments as $comment)
        <div class="panel panel-info">
            <div class="panel-body">
                {!! $comment->name !!} ( {!! $comment->created_at!!} ): {!!  $comment->body !!}
            </div>
        </div>
    @endforeach
@endif