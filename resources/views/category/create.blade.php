@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Add Category</h1>

            {!! Form::open(['url' => 'categories', 'files' => true]) !!}
            
            <div class="form-group">
                {!! Form::label('Category Name', 'Category Name:') !!}
                {!! Form::text('display_name', null, ['class'=>'form-control']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
