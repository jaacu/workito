@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-sm-12 my-2">
			<h1>Editando: "{{$proyecto->nombre}}"</h1>
		</div>
		<div class="col-sm-12 my-2">
			@if( $errors->has('facebook')  and $errors->has('twitter') and $errors->has('instagram') )
			<div class="alert-danger alert">
				Por favor seleccione al menos una red social.
			</div>
			@endif
			<div class="">
				<form action="{{ route('proyecto.adminSocialNetworks.edit',$proyecto->id) }}" method="POST">
					{{csrf_field()}}
					
					<div class="form-row">
						<div class="col-sm-8 text-center mx-auto"> 
							<label for="nombre" class="">Nombre de la empresa o persona:</label>
							<input id="nombre" type="text" class="form-control @if( $errors->has('nombre')) is-invalid @endif" name="nombre" value="{{ $proyecto->nombre }}" required autofocus>
							@foreach($errors->get('nombre') as $error)
							<div class="invalid-feedback">
								<strong> {{ $error }}</strong>
							</div>
							@endforeach
						</div>
					</div>
					<div class="border rounded border-secondary my-2 p-2">
						<div class="form-row">
							<div class="col-sm-8 text-center mx-auto"> 
								<div class="form-check mt-2">
									<label for="facebook" class="form-check-label " > {{-- <a href="" data-toggle="collapse" href="#facebookBox" role="button" aria-expanded="false" aria-controls="facebookBox"></a> --}}Facebook:</label>
									<input id="facebook" type="checkbox" value="1" class="form-check-input ml-3" name="facebook" @if( $proyecto->facebook) checked @endif>
								</div>
							</div>
						</div>
						<div class="" id="facebookBox">
							<div class="form-row m-3 p-3">
								<div class="col-sm-12 text-center"> 
									<label for="fbPermisosCompra" class="">Facebook Permisos de Compra:</label>
									<input id="fbPermisosCompra" type="text" class=" text-center form-control @if( $errors->has('fbPermisosCompra')) is-invalid @endif" name="fbPermisosCompra" value="{{ $proyecto->fbPermisosCompra }}" >
									@foreach($errors->get('fbPermisosCompra') as $error)
									<div class="invalid-feedback">
										<strong> {{ $error }}</strong>
									</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
					<div class="border rounded border-secondary my-2 p-2">
						<div class="form-row">
							<div class="col-sm-8 text-center mx-auto"> 
								<div class="form-check mt-2">
									<label for="twitter" class="form-check-label " >Twitter:</label>
									<input id="twitter" type="checkbox" value="1" class="form-check-input ml-3 text-center" name="twitter" @if( $proyecto->twitter) checked @endif>
								</div>
							</div>
						</div>

						<div class="form-row m-3 p-2">
							<div class="col-sm-6 text-center"> 
								<label for="twEmail" class="">Email de Twitter:</label>
								<input id="twEmail" type="email" class="text-center form-control @if( $errors->has('twEmail')) is-invalid @endif" name="twEmail" value="{{ $proyecto->twEmail }}" >
								@foreach($errors->get('twEmail') as $error)
								<div class="invalid-feedback">
									<strong> {{ $error }}</strong>
								</div>
								@endforeach
							</div>

							<div class="col-sm-6 text-center"> 
								<label for="twPassword" class="">Contraseña de Twitter:</label>
								<input id="twPassword" type="text" class="text-center form-control @if( $errors->has('twPassword')) is-invalid @endif" name="twPassword" value="{{ $proyecto->twPassword }}" >
								@foreach($errors->get('twPassword') as $error)
								<div class="invalid-feedback">
									<strong> {{ $error }}</strong>
								</div>
								@endforeach
							</div>
						</div>
					</div>
					
					<div class="border rounded border-secondary my-2 p-2">
						<div class="form-row">
							<div class="col-sm-8 text-center mx-auto"> 
								<div class="form-check mt-2">
									<label for="instagram" class="form-check-label " >Instagram:</label>
									<input id="instagram" type="checkbox" value="1" class="form-check-input ml-3" name="instagram" @if( $proyecto->instagram) checked @endif>
								</div>
							</div>
						</div>

						<div class="form-row m-3 p-2">
							<div class="col-sm-6 text-center"> 
								<label for="instEmail" class="">Email de Instagram:</label>
								<input id="instEmail" type="email" class="text-center form-control @if( $errors->has('instEmail')) is-invalid @endif" name="instEmail" value="{{ $proyecto->instEmail }}" >
								@foreach($errors->get('instEmail') as $error)
								<div class="invalid-feedback">
									<strong> {{ $error }}</strong>
								</div>
								@endforeach
							</div>

							<div class="col-sm-6 text-center"> 
								<label for="instPassword" class="">Contraseña de Twitter:</label>
								<input id="instPassword" type="text" class=" text-center form-control @if( $errors->has('instPassword')) is-invalid @endif" name="instPassword" value="{{ $proyecto->instPassword }}" >
								@foreach($errors->get('instPassword') as $error)
								<div class="invalid-feedback">
									<strong> {{ $error }}</strong>
								</div>
								@endforeach
							</div>
						</div>
					</div>

					<div class="form-row">
						<div class="col-sm-12 mt-4 ">
							<button class="btn-primary btn btn-lg" type="submit"> 
								Guardar Cambios.
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection