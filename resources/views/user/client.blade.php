<h1>Datos del Cliente:</h1>
<p> Nombre: {{  $user->name }} </p>
<p> Email: {{ $user->email }} </p>
<p> NIF: {{ $user->NIF}} </p>
<p> Contacto: {{ $user->contacto }} </p>
<p> Cuenta de Skype: {{ $user->cuentaSkype }} </p>
@if( $user->confirmed )
<p>Firma Digital: {{$user->digital_sign}} </p>
@else
<p style="color: red;">Este usuario no ha verificado su cuenta.</p>
@endif