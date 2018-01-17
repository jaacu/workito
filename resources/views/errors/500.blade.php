@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row my-3">
		<div class="col-sm-12 mt-5">
			<div class="alert alert-info text-center">
				<h1 class="alert-heading"><strong>Algo ha salido mal!</strong></h1>
				<p>Por favor vuelve a intentarlo luego.</p>
				<hr>
				<p><a class="btn btn-primary btn-large" href="{{ route('home')}}">Volver a al inicio.</a></p>
			</div>
		</div>
	</div>
</div>
@endsection