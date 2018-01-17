<div class="row">
	<div class="col-sm-12">
		<h4 class="text-center">Nombre Empresa o Persona: <a class="text-dark" href="{{ route('proyecto.show.type',[$proyecto->getType(),$proyecto->id]) }}">{{ $proyecto->nombre }}</a> </h4>
	</div>
	@if($proyecto->facebook)
	<div class="col-sm-6">
		<div class="border rounded p-2 h-100 border-secondary">
			<h6>Datos de Facebook:</h6>
			<p> Permisos de compra: <strong class="text-dark">{{ $proyecto->fbPermisosCompra}}</strong></p>
		</div>
	</div>
	@endif
	@if($proyecto->twitter)
	<div class="col-sm-6">
		<div class="border rounded p-2 h-100 border-secondary">
			<h6>Datos de Twitter:</h6>
			<p>Email de twitter: <strong class="text-dark">{{$proyecto->twEmail}}</strong></p>
			<p>Password de twitter: <strong class="text-dark">{{$proyecto->twPassword}}</strong></p>
		</div>
	</div>
	@endif
	@if($proyecto->instagram)
	<div class="col-sm-6">
		<div class="border rounded p-2 h-100 mt-2 border-secondary">
			<h6>Datos de Instagram:</h6>
			<p>Email de instagram: <strong class="text-dark">{{$proyecto->instEmail}}</strong></p>
			<p>Password de instagram: <strong class="text-dark">{{$proyecto->instPassword}}</strong></p>
		</div>
	</div>
	@endif
	@if( Auth::user()->isAdmin() or Auth::user()->id == $proyecto->user->id )
	<div class="col-sm-12 mt-3 text-center">
		<a href="{{ route('proyecto.adminSocialNetworks.editar', $proyecto->id) }}" class="btn btn-info w-25 text-center">Editar.</a>
	</div>
	@endif
</div>