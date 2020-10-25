@extends('layouts.app')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
         @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
         @endforeach
        
    </div>
@endif



<form action="{{route('posts.update', $post->id)}}" method='post' enctype="multipart/form-data">
	@csrf
	@method('PATCH')

{{-- <img src="{{asset('storage/' . $post->img)}}" alt="{{$post->slug}}"> --}}
	<img src="{{Storage::url($post->img)}}" alt="" width="300px">


	
  <div class="form-group">
    <label for="title">Titolo</label>
    <input type="text" class="form-control" name='title' value="{{$post->title}}">
  </div>

   <div class="form-group">
    <label for="img">Modifica Avatar</label>
    <input type="file" name='img' accept="image/*">
  </div>
  
  <div class="form-group">
    <label for="body"></label>
    <textarea class="form-control" id="body" name='body' rows="3">{{$post->body}}</textarea>
  </div>

   {{-- tag --}}
	  <div class="form-group">
		  @foreach ($tags as $tag)
	  		 <label for="tag-{{$tag->name}}" class="ml-4">{{$tag->name}}</label>
			 <input type="checkbox" name="tags[]" id="tag-{{$tag->name}}" value="{{$tag->id}}" {{($post->tags->contains($tag->id) ? 'checked' : '')}} >
		  @endforeach
	  </div>

  
  <button type="submit" class="btn btn-primary">Edit</button>
</form>
	 
@endsection