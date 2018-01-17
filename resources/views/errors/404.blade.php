@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row my-3">
		<div class="col-sm-12 mt-5">
			<div class="alert alert-primary text-center">
				<h1 class="alert-heading"><strong>La pagina que buscas no existe.</strong></h1>
				<hr>
				<p><a class="btn btn-primary btn-large" href="{{ route('home')}}">Volver a al inicio.</a></p>
			</div>
		</div>
	</div>
</div>
@endsection