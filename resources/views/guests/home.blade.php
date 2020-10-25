@extends('layouts.app')

@section('content')






<div class="jumbotron mt-5">
	@guest
		<h1 class="text-center display-4">Benvenuto nel mio blog</h1>
		<h2 class="text-center">Come Ospite</h2>
	@else
		<h1 class="text-center display-4">Bentornato nel mio blog</h1>
		<h2 class="text-center">{{Auth::user()->name}}</h2>
	@endguest
  
  <hr class="my-5">
  <div class="text-center">
	 <a class="btn btn-secondary btn-lg" href="{{route('guest.posts.home')}}" role="button">Entra</a>
	 </div>
</div>
  
@endsection


