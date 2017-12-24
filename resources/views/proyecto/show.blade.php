@extends('layouts.app')

@section('content')
@unless( isset($type) )
@include('proyecto.proyecto')
@endunless

@isset( $type )
@include($view)
<p>Cliente: <a href="/user/{{$proyecto->user->id}}">{{ $proyecto->user->name}} </a></p>
@endisset

@endsection