@extends('layouts.app')

@section('content')

<div>
	<h1>Editar el Dossier: {{$proyecto->nombre}}</h1>
	<form action="/proyectoDossier/edit/{{$proyecto->id}}" method="POST">
		<div class="form-group">
			<p>Nombre de la empresa: </p>
			<input type="text" name="Nombre" class="form-control" value="{{ $proyecto->Nombre }}" autofocus="autofocus" >
			@if( $errors->has('Nombre') )
			@foreach($errors->get('Nombre') as $error)
			<div style="color: red;">{{$error}}</div>
			@endforeach
			@endif
			
			<p>Descripcion de la empresa: </p>
			<input type="text" name="queEs" class="form-control" value="{{ $proyecto->queEs }}">
			@if( $errors->has('queEs') )
			@foreach($errors->get('queEs') as $error)
			<div style="color: red;">{{$error}}</div>
			@endforeach
			@endif

			<p>Hacia que publico va dirigido? </p>
			<input type="text" name="publico" class="form-control" value="{{ $proyecto->publico }}">
			@if( $errors->has('publico') )
			@foreach($errors->get('publico') as $error)
			<div style="color: red;">{{$error}}</div>
			@endforeach
			@endif

			<p>Mision de la empresa: </p>
			<input type="text" name="mision" class="form-control" value="{{ $proyecto->mision }}">
			@if( $errors->has('mision') )
			@foreach($errors->get('mision') as $error)
			<div style="color: red;">{{$error}}</div>
			@endforeach
			@endif

			<p>Vision de la empresa: </p>
			<input type="text" name="vision" class="form-control" value="{{ $proyecto->vision }}">
			@if( $errors->has('vision') )
			@foreach($errors->get('vision') as $error)
			<div style="color: red;">{{$error}}</div>
			@endforeach
			@endif

			<p>Valores de la empresa: </p>
			<input type="text" name="valores" class="form-control" value="{{ $proyecto->valores }}">
			@if( $errors->has('valores') )
			@foreach($errors->get('valores') as $error)
			<div style="color: red;">{{$error}}</div>
			@endforeach
			@endif

			<p>Que servicios ofrece la empresa? </p>
			<input type="text" name="servicios" class="form-control" value="{{ $proyecto->servicios }}">
			@if( $errors->has('servicios') )
			@foreach($errors->get('servicios') as $error)
			<div style="color: red;">{{$error}}</div>
			@endforeach
			@endif

			<p>Cuales son las proyecciones de crecimiento de la empresa? </p>
			<input type="text" name="crecimiento" class="form-control" placeholder="Ejem: Deseamos tener más de 100 campañas por semana." value="{{ $proyecto->crecimiento }}">
			@if( $errors->has('crecimiento') )
			@foreach($errors->get('crecimiento') as $error)
			<div style="color: red;">{{$error}}</div>
			@endforeach
			@endif

			<p>Que se puede encontrar en la empresa? </p>
			<input type="text" name="que_se_puede_encontrar" class="form-control" value="{{ $proyecto->que_se_puede_encontrar }}">
			@if( $errors->has('que_se_puede_encontrar') )
			@foreach($errors->get('que_se_puede_encontrar') as $error)
			<div style="color: red;">{{$error}}</div>
			@endforeach
			@endif

			<p>Describe en 4 palabras las cualidades de la empresa: </p>
			<input type="text" name="cualidades" class="form-control" placeholder="calidad, multitareas..." value="{{ $proyecto->cualidades }}">
			@if( $errors->has('cualidades') )
			@foreach($errors->get('cualidades') as $error)
			<div style="color: red;">{{$error}}</div>
			@endforeach
			@endif

			<p>Comentarios extra: </p>
			<input type="text" name="comentarios" class="form-control" value="{{ $proyecto->comentarios }}">
			@if( $errors->has('comentarios') )
			@foreach($errors->get('comentarios') as $error)
			<div style="color: red;">{{$error}}</div>
			@endforeach
			@endif

			{{csrf_field()}}
			<input type="submit" value="Guardar" >
		</div>

	</form>
</div>
@endsection