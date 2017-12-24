<div>
	<h4>Nombre Empresa o Persona: {{ $proyecto->nombre}} </h4>
	@if($proyecto->facebook)
	<p> Permisos de compra algo: {{ $proyecto->fbPermisosCompra}}</p>
	@endif
	@if($proyecto->twitter)
	<p>Email de twitter: {{$proyecto->twEmail}}</p>
	<p>Password de twitter: {{$proyecto->twPassword}}</p>
	@endif
	@if($proyecto->instagram)
	<p>Email de instagram: {{$proyecto->instEmail}}</p>
	<p>Password de instagram: {{$proyecto->instPassword}}</p>
	@endif
</div>