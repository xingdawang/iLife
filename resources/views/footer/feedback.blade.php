{!! Form::open([
            'method' => 'POST',
            'route' => 'feedback_email',
            'class' => 'form-horizontal'
        ]) !!}
    <fieldset>
    <div align="right">
        <div class="form-group">
            {!! Form::label('title', 'Title:', ['class'=>'col-lg-3 control-label']) !!}
            <div class="col-lg-8">
                {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'feedback title']) !!}
            </div>
        </div>
        <br >
        <div class="form-group">
            {!! Form::label('Feedback', 'Feedback', ['class' => 'col-lg-3 control-label']) !!}
            <div class="col-lg-8">
                {!! Form::textarea('feedback', null, [
                'class' => 'form-control',
                'rows'=>'13',
                'id'=>'textArea',
                'placeholder' => 'This is the main part of the feedback']) !!}
            </div>
            <div class="col-lg-3">
            </div>
            <div class="col-lg-8">
                <font color="#00bfff">If you want to get a feedback email, please add your personal email address above</font>
            </div>
        </div>
        <br >
        <div class="form-group">
            <div class="col-lg-11">
                {!! Form::submit('Send', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    </div>
    </fieldset>
{!! Form::close() !!}