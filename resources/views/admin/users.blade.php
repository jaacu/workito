@extends('layouts.app')

@section('content')
<div class="container mt-3">
	@forelse($users as $user)
	@if($loop->first)
	<div class="row">
		<div class="col-sm-6">
			<h3 class="text-dark text-center">Usuarios</h3>
		</div>
		<div class="col-sm-6">
			@include('searchBar', ['action' =>route('admin.buscar.user')])
		</div>
	</div>
	<hr class="mt-3 mb-3">
	<div class="row">
		@endif
		@include('user.userMIN')
		@if($loop->last)
	</div>
	@endif
	@empty
	<div class="row">
		<div class="col-sm-12 alert alert-warning">
			<h4 class="alert-heading">Parece que no hay ningun usuario registrado!</h4>
			<hr>
			<a href="{{ route('user.crear.admin') }}" class="btn btn-primary">Crear un nuevo usuario ahora.</a>
		</div>
	</div>
	@endforelse
</div>

@endsection