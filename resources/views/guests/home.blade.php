@extends('layouts.app')

@section('content')

<h1 class="text-center display-4">Benvenuto nel mio blog</h1>

@guest
   <h2 class="lead text-center display-5">Ospite</h2>
@else
   <h2 class="lead text-center display-5">{{Auth::user()->name}}</h2>
@endguest
  
@endsection


