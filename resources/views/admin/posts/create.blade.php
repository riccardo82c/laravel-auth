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

  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
	 
@endsection