<ul class="list-group">
@foreach($categories as $category)
    <li class="list-group-item">
            <a href=" {!! url('/categories', $category->id) !!}">{!! $category->name  !!}</a>
            <span class="badge">{!! $articlesNumber[$category->id] !!}</span>
    </li>
@endforeach
</ul>