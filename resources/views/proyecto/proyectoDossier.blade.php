<div>
	<h4>Nombre Empresa: {{ $proyecto->Nombre }} </h4>
	<p>Descripcion de la empresa: {{ $proyecto->queEs }}</p>
	<p>Hacia que publico va dirigido: {{ $proyecto->publico }}</p>
	<p>Mision de la empresa: {{ $proyecto->mision }}</p>
	<p>Vision de la empresa: {{ $proyecto->vision }}</p>
	<p>Valores de la empresa: {{ $proyecto->valores }}</p>
	<p>Que servicios ofrece la empresa: {{ $proyecto->servicios }}</p>
	<p>Proyecciones de crecimiento: {{ $proyecto->crecimiento }}</p>
	<p>Que se puede encontrar en la empresa: {{ $proyecto->que_se_puede_encontrar }}</p>
	<p>Cualidades que describen la empresa: {{ $proyecto->cualidades }}</p>
	@if( $proyecto->comentarios)
	<p>Comentarios extra: {{ $proyecto->comentarios }}</p>
	@endif
</div>