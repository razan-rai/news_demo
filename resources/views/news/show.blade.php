@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
             <div class="col-sm-2 paddingTop20">
            <nav class="nav-sidebar">
            <h2>All News</h2>
                <ul class="nav">
                    
                    @foreach($newsall as $newss)
                    <li>>><a href="{{ url('news',$newss->id) }}">{{$newss->title}}</a></li>
                    @endforeach
                </ul>
            </nav>
        </div>  
    
     <div class="col-md-10 blogShort">
         <h1>{{$news->title}}</h1>
         <img src="{{url($news->image)}}" alt="post img" class="pull-left img-responsive postImg img-thumbnail margin10" style="height: 500px; width: 500px">
         <article>
         <p>{{$news->content}}</p>
         </article>
         <p class="float-left">Published on: <input  class="float-right" type="" name="" placeholder="{{$news->publish_date}}" readonly=""></p>
         <p class="float-left">Author: <input  class="float-right" type="" name="" placeholder="{{$news->author}}" readonly=""></p>
        
     </div>
    </div>
</div>
@endsection