@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-12 mt-5">
			<h1 class=" text-center">Tu perfil</h1><br>
			<h4>Tus datos:</h4><br>
		</div>
		<div class="col-sm-12 ml-4">
			<div class="row">
				<div class="col-sm-6">
					<p class="lead"> Nombre: <strong class="text-dark">{{  Auth::user()->name }}</strong> </p>
				</div>
				<div class="col-sm-6">
					<p class="lead"> Email: <strong class="text-dark">{{ Auth::user()->email }}</strong> </p>
				</div>
				<div class="col-sm-6">
					<p class="lead"> Skype: <strong class="text-dark">{{ Auth::user()->cuentaSkype }}</strong></p>
				</div>
				<div class="col-sm-6">
					<p class="lead"> Contacto: <strong class="text-dark">{{ Auth::user()->contacto }}</strong></p>
				</div>
				<div class="col-sm-6">
					<p class="lead"> NIF: <strong class="text-dark">{{ Auth::user()->NIF }}</strong></p>
				</div>
				<div class="col-sm-6">
					<p class="lead"> Antiguedad: <strong class="text-dark">{{ Auth::user()->forHumansCreado() }}</strong></p>
				</div>
				<div class="col-sm-6">
					<a href="{{ route('user.editar') }}" class="btn btn-outline-success btn-lg">Editar Datos</a>
				</div>
			</div>
		</div>
		{{-- <div class="col-sm-12">
			<hr><br>
			<h4>Tus interacciones con el mundo!</h4> <br>
			<div class="mb-3">
				<h5 class="text-center">Proyectos activos: <span class="text-info">{{ Auth::user()->devs->count() }}</span></h5>
				<h5 class="text-center">Comentarios activos: <span class="text-info">{{ Auth::user()->comments->count() }}</span></h5>
			</div>
			<br>
			<hr>
		</div>
		<div class="col-sm-12 my-3">
			@include('notifications')
		</div> --}}
		<br><br>
	</div>
</div>
@endsection