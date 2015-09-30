@if($comments != null)
    @foreach($comments as $comment)
        <div class="panel panel-info">
            <div class="panel-body">

                <!-- If the user is a manager, let the font color be red!-->
                @if($comment->is_manager)
                    <font color="red">
                @endif

                <strong>
                    {!! $comment->name !!}
                    ( {!! $comment->created_at!!} ):
                </strong>
                <br>
                {!!  nl2br($comment->body) !!}

                <!-- If the user is a manager, let the font color be red!-->
                @if($comment->is_manager)
                    <br />
                    (Administrator)
                    </font>
                @endif

                <!-- If the user is a manager, let him or het having the delete right!-->
                @if($is_manager)
                    @include('comments.delete')
                @endif
            </div>
        </div>
    @endforeach
@endif