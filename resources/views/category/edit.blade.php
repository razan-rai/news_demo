@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Update Category</h1>
            {{ Form::model($edit_category, ['route' => ['categories.update', $edit_category->id], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'files'=>true,]) }}
            
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
