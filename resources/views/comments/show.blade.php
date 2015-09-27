@if($comments != null)
    @foreach($comments as $comment)
        <div class="panel panel-info">
            <div class="panel-body">
                <strong>{!! $comment->name !!} ( {!! $comment->created_at!!} ): </strong><br>{!!  nl2br($comment->body) !!}
                @if($is_manager)
                    @include('comments.delete')
                @endif
            </div>
        </div>
    @endforeach
@endif