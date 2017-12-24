<p>Proyecto creado por el <span style="color: blue;"> administrador</span> {{ $proyecto->user->name }} bajo el nombre de: "{{ $proyecto->nombre}}" </p>
@forelse( $proyecto->devs as $dev )

@if( $loop->first)
<p>Proyecto asignado a: </p>
<ul>
	@endif
	<li>Desarrollador: <a href="/user/{{$dev->user->id}}">{{ $dev->user->name}}</a></li>

	@if( $loop->last)
</ul>
@endif
@empty
<p>No esta asignado a nadie.</p>
@endforelse
@unless( isset($del) )
<a href="/proyecto/show/{{$proyecto->id}} ">Detalles del proyecto.</a><br>
@endunless