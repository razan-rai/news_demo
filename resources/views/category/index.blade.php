@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>News Portal</h1>
 <a href="{{ url('/categories/create') }}" class="btn btn-success">Create Category</a>
 <hr>
                      <table class="table table-striped table-advance table-hover">
                       <tbody>
                          <tr>
                             <th><i class="fa fa-database"></i> Category</th>
                             <th><i class="fa fa-database"></i> Slug</th>
                             <th><i class="fa fa-calendar"></i> Updated At</th>
                             <th><i class="icon_cogs"></i> Action</th>
                          </tr>
                          @foreach ($categories as $category)
                          <tr>
                             <td>{{ $category->display_name}}</td>
                             <td>{{ $category->name}}</td>
                             <td>{{ $category->created_at->diffForHumans()}}</td>
                             <td>
                              <div class="btn-group">
                                  <a class="btn btn-primary" href="{{ url('categories/' . $category->id . '/edit') }}"><i class="fa fa-edit"></i>Edit</a>
                                  {!! Form::open(['method' => 'DELETE', 'route'=>['categories.destroy', $category->id]]) !!}
                               {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                               {!! Form::close() !!}
                              </div>
                              </td>
                          </tr>
                          @endforeach                            
                       </tbody>
                    </table>
                {!! $categories->render() !!}
                </div>
<!-- End projects list -->
<div class="clearfix"> </div>
@endsection