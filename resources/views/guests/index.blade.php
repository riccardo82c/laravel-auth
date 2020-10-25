@extends('layouts.app')

@section('content')

<div class="card-group">
	<div class="row">
		@foreach ($posts as $post)

		<div class="offset-md-2 col-md-8 offset-lg-0 col-lg-6 col-xl-4 pt-3">
			<div class="card">
				<img src="{{Str::startsWith($post->img,'http') ? $post->img : Storage::url($post->img)}}" class="card-img-top" alt="">
				<div class="card-body">
					<h5 class="card-title">{{$post->title}}</h5>
					<p class="card-text">{{Str::substr($post->body,0,150). "..."}}</p>
					<p class="card-text"><small class="text-muted">{{$post->user->name}}</small></p>
					<div class="text-right">
					<strong>Tags: </strong>
               @foreach ($post->tags as $tag) 
						<span class="text-muted">{{ $tags->find($tag->pivot->tag_id)->name }} </span>
					@endforeach
					</div>

					<a href="{{route('guest.posts.show',$post->slug)}}" class="btn btn-primary">Dettagli</a>
				</div>
			</div>
		</div>

		@endforeach 
	
	</div>
</div>

@endsection

