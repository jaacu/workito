<div class="row">
	<div class="col-sm-12">
		<h4 class="text-center"> Nombre Empresa: <a class="text-dark" href="{{ route('proyecto.show.type',[$proyecto->getType(),$proyecto->id]) }}">{{ $proyecto->nombre }}</a></h4>
	</div>
	<div class="col-sm-4 mt-4">
		<div class="border rounded p-2 h-100 border-info text-justify">
			<p>Descripcion de la empresa: <br><strong class="text-dark">{{ $proyecto->queEs }}</strong></p>	
		</div>
	</div>
	<div class="col-sm-4 mt-4">
		<div class="border rounded p-2 h-100 border-info text-justify">	
			<p>Hacia que publico va dirigido: <br><strong class="text-dark">{{ $proyecto->publico }}</strong></p>
		</div>
	</div>
	<div class="col-sm-4 mt-4">
		<div class="border rounded p-2 h-100 border-info text-justify">	
			<p>Mision de la empresa: <br><strong class="text-dark">{{ $proyecto->mision }}</strong></p>
		</div>
	</div>
	<div class="col-sm-4 mt-4">
		<div class="border rounded p-2 h-100 border-info text-justify">	
			<p>Vision de la empresa: <br><strong class="text-dark">{{ $proyecto->vision }}</strong></p>
		</div>
	</div>
	<div class="col-sm-4 mt-4">
		<div class="border rounded p-2 h-100 border-info text-justify">	
			<p>Valores de la empresa: <br><strong class="text-dark">{{ $proyecto->valores }}</strong></p>
		</div>
	</div>
	<div class="col-sm-4 mt-4">
		<div class="border rounded p-2 h-100 border-info text-justify">	
			<p>Que servicios ofrece la empresa: <br><strong class="text-dark">{{ $proyecto->servicios }}</strong></p>
		</div>
	</div>
	<div class="col-sm-4 mt-4">
		<div class="border rounded p-2 h-100 border-info text-justify">	
			<p>Proyecciones de crecimiento: <br><strong class="text-dark">{{ $proyecto->crecimiento }}</strong></p>
		</div>
	</div>
	<div class="col-sm-4 mt-4">
		<div class="border rounded p-2 h-100 border-info text-justify">	
			<p>Que se puede encontrar en la empresa: <br><strong class="text-dark">{{ $proyecto->que_se_puede_encontrar }}</strong></p>
		</div>
	</div>
	<div class="col-sm-4 mt-4">
		<div class="border rounded p-2 h-100 border-info text-justify">	
			<p>Cualidades que describen la empresa: <br><strong class="text-dark">{{ $proyecto->cualidades }}</strong></p>
		</div>
	</div>
	@if( $proyecto->comentarios)
	<div class="col-sm-8 mt-4 mx-auto">
		<div class="border rounded p-2 h-100 border-info text-justify">	
			<p>Comentarios extra: <br><strong class="text-dark">{{ $proyecto->comentarios }}</strong></p>
		</div>
	</div>
	@endif
	@if( Auth::user()->isAdmin() or Auth::user()->id == $proyecto->user->id )
	<div class="col-sm-12 mt-3 text-center">
		<a href="{{ route('proyecto.dossier.editar', $proyecto->id) }}" class="btn btn-info w-25 text-center">Editar.</a>
	</div>
	@endif
</div>