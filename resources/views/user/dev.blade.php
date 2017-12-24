<h1>Datos del Desarrollador:</h1>
<p> Nombre: {{  $user->name }} </p>
<p> Email: {{ $user->email }} </p>
<p> Cuenta de Skype: {{ $user->cuentaSkype }} </p>
@forelse( $user->devs as $dev )
@if( $loop->first)
<h3>Proyectos en los que esta trabajando  este desarrollador:</h3>
@endif
<p>Nombre del proyecto: {{ $dev->proyect->nombre }}</p>
<p>Tiempo trabajado en este proyecto @include('dev.trabajado')</p>
<p><a href="/proyecto/show/{{$dev->proyect->id}}">Mas detalles sobre este proyecto.</a></p>
<hr style="border: solid;">
@empty
<p>Este desarrollador no tiene proyectos asignados.</p>
@endforelse
