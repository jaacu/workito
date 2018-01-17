@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-12 mt-5">
			<h1 class=" text-center">Tu perfil</h1><br>
			<h4>Tus datos:</h4><br>
			<div class="ml-4">
				<p class="lead"> Nombre: <strong class="text-dark">{{  Auth::user()->name }}</strong> </p>
				<p class="lead"> Email: <strong class="text-dark">{{ Auth::user()->email }}</strong> </p><br>
				<div class="text-right">
					<a href="{{ route('user.editar') }}" class="text-right btn btn-outline-success btn-lg">Editar Datos</a>
				</div>
				<p class="lead"></p>
			</div>
			<hr><br>
			<h4>Tus interacciones con el mundo!</h4> <br>
			<div class="mb-3">
				<h5 class="text-center">Proyectos activos: <span class="text-info">{{ Auth::user()->proyects->count() }}</span></h5>
				<h5 class="text-center">Comentarios activos: <span class="text-info">{{ Auth::user()->comments->count() }}</span></h5>
			</div>
			<br>
			<hr>
			@include('notifications')
			<br><br>
		</div>
	</div>
</div>

@endsection