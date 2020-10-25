@extends('layouts.app')

@section('content')

@if (session('status')) 
<div class="alert alert-{{session('status')[0]}}">
		<p>{{session('status')[1]}}</p>
</div>
@endif



<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
		<th scope="col">TITLE</th>
		<th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
	  @foreach ($posts as $post)
    <tr>
	 <th scope="row">{{$post->id}}</th>
      <td>{{$post->title}}</td>
	 	<td><a class='btn btn-primary' href="{{route('posts.edit',$post->id)}}">Edit</a></td>
      <td>
		<form action="{{route('posts.destroy',$post->id)}}" method="post">
				@csrf
				@method('DELETE')
				<button type="submit" class='btn btn-danger'>Delete</button>
		</form>
		</td>
	 </tr>
	 @endforeach
   </tbody>
</table>


<div class="mt-5">
	{{$posts->links()}}
</div>
  
@endsection