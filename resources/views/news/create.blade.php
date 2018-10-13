@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Add News</h1>

            {!! Form::open(['url' => 'news', 'files' => true]) !!}
            <div class="form-group">
            {!! Form::label('Category', 'Category:') !!}
                <select id="categories" name="category[]" multiple>
                @foreach($categories as $category)
                    <option value="{{$category->id}}"><strong>{{$category->display_name}}</strong></option>
                @endforeach
        </select>
            </div>
            <div class="form-group">
                {!! Form::label('Title', 'Title:') !!}
                {!! Form::text('title', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
            <!-- And clicking on this button will open up select file dialog -->
                  <div class="select-image-btn">Select new image</div>
              <div id="image-cropper">
                  <div class="cropit-preview"></div>
                  
                  <input type="range" class="cropit-image-zoom-input" />
                  
                  <!-- The actual file input will be hidden -->
                  <input type="file" name="image" class="cropit-image-input" />
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('News Editor', 'News Editor:') !!}
                {{ Form::textarea('detail', null, ['class' => 'form-control input-add textt', 'id' => 'summernote', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => 'Enter Equipment Details']) }}
            </div>
            <div class="form-group">
                {!! Form::label('Author', 'Author:') !!}
                {!! Form::text('author', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Publish Date', 'Publish Date:') !!}
                {!! Form::date('publish_date', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
 <!-- multiselect -->
    {!! Html::script('js/jquery.multi-select.js') !!}

    <!-- cropit -->
    {!! Html::script('js/jquery.cropit.js') !!}
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/3.8.3/summernote.js"></script> -->
<script>
    $(document).ready(function () {
        $('#image-cropper').cropit();

        // When user clicks select image button,
        // open select file dialog programmatically
        $('.select-image-btn').click(function() {
          $('.cropit-image-input').click();
        });

        // Handle rotation
        $('.rotate-cw-btn').click(function() {
          $('#image-cropper').cropit('rotateCW');
        });
        $('.rotate-ccw-btn').click(function() {
          $('#image-cropper').cropit('rotateCCW');
        });

        $('.rotate-cw').click(function() {
          $('.image-editor').cropit('rotateCW');
        });
        $('.rotate-ccw').click(function() {
          $('.image-editor').cropit('rotateCCW');
        });

        $('#categories').multiSelect({
            noneText: 'All categories',
            
        });


    });

</script> 

@endsection
