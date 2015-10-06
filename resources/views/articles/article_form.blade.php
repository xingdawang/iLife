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
            'rows'=>'8',
            'id'=>'textArea',
            'placeholder' => 'This is the main part of the article']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('category', 'Category:', ['class' => 'col-lg-2 control-label']) !!}
        <div class="col-lg-8">
            {!! Form::select('category_id',$category_list, null, ['class' => 'form-control', 'id' => 'select']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('article_img', 'Article Image:', ['class' => 'col-lg-2 control-label']) !!}
        <div class="col-lg-8">
            {!! Form::file('title_img') !!}
            {!! Form::label('article_img', '(1035 px width preferred)') !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('body_img', 'Body Image:', ['class' => 'col-lg-2 control-label']) !!}
        <div class="col-lg-8">
            {!! Form::file('body_img') !!}
            {!! Form::label('article_img', '(1035 px width preferred)') !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('icon_img', 'Icon Image:', ['class' => 'col-lg-2 control-label']) !!}
        <div class="col-lg-8">
            {!! Form::file('article_icon_img') !!}
            {!! Form::label('article_icon_img', '(75 * 75 px width preferred)') !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('set_top', 'Set Top:', ['class' => 'col-lg-2 control-label']) !!}
        <div class="col-lg-8">
            {!! Form::select('is_top', array(
                '2' => 'Set Top on All Categories',
                '1' => 'Set Top on this Category',
                '0' => 'Not on top'),
                '0'
                ) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
            {!! Form::button('Cancel', ['class' => 'btn btn-default', 'type' => 'reset']) !!}
            {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
</fieldset>
<div style="height:100px">
</div>