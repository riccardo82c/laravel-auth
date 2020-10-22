@extends('layouts.app')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
         @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
         @endforeach
        
    </div>
@endif



<form action="{{route('posts.update', $post->id)}}" method='post'>
	@csrf
	@method('PATCH')
	
  <div class="form-group">
    <label for="title">Titolo</label>
    <input type="text" class="form-control" name='title' value="{{$post->title}}">
  </div>
  
  <div class="form-group">
    <label for="body"></label>
    <textarea class="form-control" id="body" name='body' rows="3">{{$post->body}}</textarea>
  </div>

  
  <button type="submit" class="btn btn-primary">Edit</button>
</form>
	 
@endsection