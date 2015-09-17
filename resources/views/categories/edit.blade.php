@extends('app')
@section('content')

    {!! Form::model($category, [
        'method' => 'PATCH',
        'action' =>['CategoriesController@update', $category->id],
        'class'=>'form-horizontal'
    ]) !!}

    <fieldset>
        <div class="form-group">
            {!! Form::label('category_title', 'Title:', ['class'=>'col-lg-2 control-label']) !!}
            <div class="col-lg-8">
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'category title']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('category_description', 'Description', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-8">
                {!! Form::textarea('description', null, ['class' => 'form-control',
                'rows'=>'4',
                'id'=>'textArea',
                'placeholder' => 'This is the description of the category title']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                {!! Form::button('Cancel', ['class' => 'btn btn-default', 'type' => 'reset']) !!}
                {!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
            </div>
        </div>
    </fieldset>
    {!! Form::close() !!}


    <!-- Delete category -->
    {!! Form::model($category, [
        'method' => 'PATCH',
        'action' =>['CategoriesController@destroy', $category->id],
        'class'=>'form-horizontal'
    ]) !!}
            <fieldset>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        {!!  Form::hidden('_method', 'DELETE')  !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
            </fieldset>
    {!! Form::close() !!}

    <!-- Error lists-->
    <div class="form-horizontal">
        <div class="col-lg-2"></div>
        <div class="form-group">
            <div class="col-lg-8">
                @include('errors.error_list')
            </div>
        </div>
    </div>
@stop