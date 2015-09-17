@if ($errors->any())
    <ul class="alert alert-dismissible alert-danger">
        @foreach($errors->all() as $error)
            <li> {{ $error }} </li>
        @endforeach
    </ul>
@endif