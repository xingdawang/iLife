<ul class="list-group">
@foreach($categories as $category)
    <li class="list-group-item">
            <a href=" {!! url('/categories', $category->id) !!}">{!! $category->name  !!}</a>
            <span class="badge">{!! $articlesNumber[$category->id] !!}</span>
        @if($is_manager)
            <span class="badge">
                <a href={!! url('/categories/'.$category->id.'/edit') !!}><font color="#f0ffff">edit</font></a>
            </span>
        @endif
    </li>
@endforeach
</ul>