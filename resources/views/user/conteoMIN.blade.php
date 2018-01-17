@if($user->isDeveloper() )
<p>Este desarrollador esta trabajando en: {{ $user->devs->count()}}</p>
<p>Comentarios realizados: {{ $user->comments->count()}}</p>
@endif

@if($user->isClient())
<p>Este usuario ha creado {{ $user->getProyects()->count() }} proyectos.</p>
<p>Este usuario esta relacionado con {{ count( $user->proyectsClient() ) }} proyectos en desarrollo.</p>
@endif