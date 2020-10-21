@extends('layouts.app')

@section('content')

Benvenuto nel mio blog

@guest
   <p class="lead">Ospite</p>
@else
   <p class="lead">{{Auth::user()->name}}</p>
@endguest
  
@endsection


