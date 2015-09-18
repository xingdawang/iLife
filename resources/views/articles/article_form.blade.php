<fieldset>
    <div class="form-group">
        {!! Form::label('title', 'Title:', ['class'=>'col-lg-2 control-label']) !!}
        <div class="col-lg-8">
            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'article title']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('body', 'Main body', ['class' => 'col-lg-2 control-label']) !!}
        <div class="col-lg-8">
            {!! Form::textarea('body', null, ['class' => 'form-control',
            'rows'=>'4',
            'id'=>'textArea',
            'placeholder' => 'This is the main part of the article']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('category', 'Category:', ['class' => 'col-lg-2 control-label']) !!}
        <div class="col-lg-8">
            {!! Form::select('select',$category_list, null, ['class' => 'form-control', 'id' => 'select']) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
            {!! Form::button('Cancel', ['class' => 'btn btn-default', 'type' => 'reset']) !!}
            {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
</fieldset>