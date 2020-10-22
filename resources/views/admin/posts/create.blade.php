@extends('layouts.app')

@section('content')



<form action="{{route('posts.store')}}" method='post'>
	@csrf
	@method('POST')
	
  <div class="form-group">
    <label for="title">Titolo</label>
    <input type="text" class="form-control" name='title'>
  </div>
  
  <div class="form-group">
    <label for="body"></label>
    <textarea class="form-control" id="body" name='body' rows="3"></textarea>
  </div>

	  {{-- tag --}}
	  <div class="form-group">
		  @foreach ($tags as $tag)
	  		 <label for="tag-{{$tag->name}}" class="ml-4">{{$tag->name}}</label>
			 <input type="checkbox" name="tags[]" id="tag-{{$tag->name}}" value="{{$tag->id}}">
		  @endforeach
	  </div>

  <button type="submit" class="btn btn-primary">Submit</button>

</form>
	 
@endsection