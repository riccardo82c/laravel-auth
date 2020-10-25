@extends('layouts.app')

@section('content')
<div class="row">
	<div class="offset-xl-2 col-xl-8 pt-3">
		<div class="card">
			<img src="{{Str::startsWith($post->img,'http') ? $post->img : Storage::url($post->img)}}" class="card-img-top"
				alt="">
			<div class="card-body">
				<div class="clearfix">
					<h5 class="card-title float-left">{{$post->title}}</h5>
					<p class="card-text float-right"><small class="text-muted">{{$post->created_at}}</small></p>
				</div>
				<p class="card-text">{{$post->body}}</p>
				<p class="card-text"><small class="text-muted">{{$post->user->name}}</small></p>
			</div>
		</div>
	</div>
</div>
@endsection