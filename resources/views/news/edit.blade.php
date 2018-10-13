@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Update News</h1>

            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{ Form::model($news, ['route' => ['news.update', $news->id], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'files'=>true,]) }}
            <div class="form-group">
            {!! Form::label('Category', 'Category:') !!}
                <select id="categories" name="category[]" multiple>
                    @foreach($categories as $category)
                    @if(in_array($category->id, unserialize($news->category_id)))
                        <option value="{{ $category->id }}" selected="true">{{ $category->name }}</option>
                        @else
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
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
                  @if(isset($news->image))
                    <img src="{{url($news->image)}}" alt="equipment" class="img-thumbnail img-responsiv" style="height: 100px; width: 100px">
                  @endif
              <div id="image-cropper">

                  <div class="cropit-preview"></div>

                  <input type="range" class="cropit-image-zoom-input" />
                  
                  <!-- The actual file input will be hidden -->
                  <input type="file" name="image" class="cropit-image-input" />
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('News Editor', 'News Editor:') !!}
                {!! Form::textarea('content', null, ['class'=>'form-control ckeditor']) !!}
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

        $('#categories').multiSelect({
            noneText: 'All categories',
            
        });

        
    });

</script> 
@endsection