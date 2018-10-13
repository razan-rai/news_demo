<div class="form-group">
    {{ Form::label('category_name', 'Category', ['class' => 'control-label col-sm-2']) }}

    <div class="col-sm-10">
        {{ Form::text('category_name', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => 'Enter Category']) }}
    </div>
</div>
<hr>

          
