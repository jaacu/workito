@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-12-my-2">
			<h1>Editar el Dossier: {{$proyecto->nombre}}</h1>	
		</div>
		<div class="col-sm-12 my-2">
			<form action="{{ route('proyecto.dossier.edit',$proyecto->id) }}" method="POST">
				{{csrf_field()}}
				<div class="form-row">
					<div class="col-sm-8 text-center mx-auto"> 
						<label for="nombre" class="">Nombre de la empresa:</label>
						<input id="nombre" type="text" class=" text-center form-control @if( $errors->has('nombre')) is-invalid @endif" name="nombre" value="{{ $proyecto->nombre }}" required autofocus>
						@foreach($errors->get('nombre') as $error)
						<div class="invalid-feedback">
							<strong> {{ $error }}</strong>
						</div>
						@endforeach
					</div>
				</div>

				<div class="form-row my-3">
					<div class="col-sm-6 text-center"> 
						<div class="border border-secondary bg-light rounded p-2 m-2">
							<label for="queEs" class="">Descripcion de la empresa:</label>
							<input id="queEs" type="text" class=" text-center form-control @if( $errors->has('queEs')) is-invalid @endif" name="queEs" value="{{ $proyecto->queEs }}" required>
							@foreach($errors->get('queEs') as $error)
							<div class="invalid-feedback">
								<strong> {{ $error }}</strong>
							</div>
							@endforeach
						</div>
					</div>

					<div class="col-sm-6 text-center">
						<div class="border border-secondary bg-light rounded p-2 m-2">
							<label for="publico" class="">Hacia que publico va dirigido?</label>
							<input id="publico" type="text" class=" text-center form-control @if( $errors->has('publico')) is-invalid @endif" name="publico" value="{{ $proyecto->publico }}" required>
							@foreach($errors->get('publico') as $error)
							<div class="invalid-feedback">
								<strong> {{ $error }}</strong>
							</div>
							@endforeach
						</div>
					</div>
				</div>
				
				<div class="form-row my-3">
					<div class="col-sm-6 text-center">
						<div class="border border-secondary bg-light rounded p-2 m-2">
							<label for="mision" class="">Mision de la empresa:</label>
							<input id="mision" type="text" class=" text-center form-control @if( $errors->has('mision')) is-invalid @endif" name="mision" value="{{ $proyecto->mision }}" required>
							@foreach($errors->get('mision') as $error)
							<div class="invalid-feedback">
								<strong> {{ $error }}</strong>
							</div>
							@endforeach
						</div>
					</div>

					<div class="col-sm-6 text-center">
						<div class="border border-secondary bg-light rounded p-2 m-2">
							<label for="vision" class="">Vision de la empresa:</label>
							<input id="vision" type="text" class=" text-center form-control @if( $errors->has('vision')) is-invalid @endif" name="vision" value="{{ $proyecto->vision }}" required>
							@foreach($errors->get('vision') as $error)
							<div class="invalid-feedback">
								<strong> {{ $error }}</strong>
							</div>
							@endforeach
						</div>
					</div>
				</div>

				<div class="form-row my-3">
					<div class="col-sm-6 text-center">
						<div class="border border-secondary bg-light rounded p-2 m-2">
							<label for="valores" class="">Valores de la empresa:</label>
							<input id="valores" type="text" class=" text-center form-control @if( $errors->has('valores')) is-invalid @endif" name="valores" value="{{ $proyecto->valores }}" required>
							@foreach($errors->get('valores') as $error)
							<div class="invalid-feedback">
								<strong> {{ $error }}</strong>
							</div>
							@endforeach
						</div>
					</div>

					<div class="col-sm-6 text-center">
						<div class="border border-secondary bg-light rounded p-2 m-2">
							<label for="servicios" class="">Que servicios ofrece la empresa?</label>
							<input id="servicios" type="text" class=" text-center form-control @if( $errors->has('servicios')) is-invalid @endif" name="servicios" value="{{ $proyecto->servicios }}" required>
							@foreach($errors->get('servicios') as $error)
							<div class="invalid-feedback">
								<strong> {{ $error }}</strong>
							</div>
							@endforeach
						</div>
					</div>
				</div>
				
				<div class="form-row my-3">
					<div class="col-sm-6 text-center">
						<div class="border border-secondary bg-light rounded p-2 m-2">
							<label for="crecimiento" class="">Cuales son las proyecciones de crecimiento de la empresa? </label>
							<input id="crecimiento" type="text" class=" text-center form-control @if( $errors->has('crecimiento')) is-invalid @endif" name="crecimiento" value="{{ $proyecto->crecimiento }}" required>
							@foreach($errors->get('crecimiento') as $error)
							<div class="invalid-feedback">
								<strong> {{ $error }}</strong>
							</div>
							@endforeach
						</div>
					</div>

					<div class="col-sm-6 text-center">
						<div class="border border-secondary bg-light rounded p-2 m-2">
							<label for="que_se_puede_encontrar" class="">Que se puede encontrar en la empresa?</label>
							<input id="que_se_puede_encontrar" type="text" class=" text-center form-control @if( $errors->has('que_se_puede_encontrar')) is-invalid @endif" name="que_se_puede_encontrar" value="{{ $proyecto->que_se_puede_encontrar }}" required>
							@foreach($errors->get('que_se_puede_encontrar') as $error)
							<div class="invalid-feedback">
								<strong> {{ $error }}</strong>
							</div>
							@endforeach
						</div>
					</div>
				</div>
				
				<div class="form-row my-3">
					<div class="col-sm-6 text-center">
						<div class="border border-secondary bg-light rounded p-2 m-2">
							<label for="cualidades" class="">Describe en 4 palabras las cualidades de la empresa: </label>
							<input id="cualidades" type="text" class=" text-center form-control @if( $errors->has('cualidades')) is-invalid @endif" name="cualidades" value="{{ $proyecto->cualidades }}" required placeholder="calidad, multitareas...">
							@foreach($errors->get('cualidades') as $error)
							<div class="invalid-feedback">
								<strong> {{ $error }}</strong>
							</div>
							@endforeach
						</div>
					</div>

					<div class="col-sm-6 text-center">
						<div class="border border-secondary bg-light rounded p-2 m-2">
							<label for="comentarios" class="">Comentarios extra:</label>
							<input id="comentarios" type="text" class=" text-center form-control @if( $errors->has('comentarios')) is-invalid @endif" name="comentarios" value=" @if($proyecto->comentarios){{ $proyecto->comentarios }} @else {{ old('comentarios') }} @endif">
							@foreach($errors->get('comentarios') as $error)
							<div class="invalid-feedback">
								<strong> {{ $error }}</strong>
							</div>
							@endforeach
						</div>
					</div>
				</div>

				<div class="form-row">
					<div class="col-sm-12 mt-4">
						<button class="btn-primary btn btn-lg ml-4" type="submit"> 
							Guardar Cambios.
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection