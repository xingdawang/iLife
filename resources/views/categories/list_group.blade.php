<!--
<ul class="list-group">
    <li class="list-group-item">
        <span class="badge">14</span>
        Cras justo odio
    </li>
    <li class="list-group-item">
        <span class="badge">2</span>
        Dapibus ac facilisis in
    </li>
    <li class="list-group-item">
        <span class="badge">1</span>
        Morbi leo risus
    </li>
-->
<ul class="list-group">
@foreach($categories as $category)
    <li class="list-group-item">
        <a href=" {!! url('/categories', $category->id) !!}">{!! $category->name  !!}</a>
    </li>
@endforeach
    <li class="list-group-item">
        <a href="{!! url('categories/create') !!}"> Add a new category</a>
    </li>
</ul>