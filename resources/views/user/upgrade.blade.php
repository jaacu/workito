@extends('layouts.app')

@section('content')
<div>
	
	@if( $errors->any() )
	@foreach($errors->all() as $error)
	<div style="color: red;">{{$error}}</div>
	@endforeach
	@endif

	<p> Usuario: {{ $user->name}}</p>
	<p>Estado: 
		@if( $user->role == 1)
		Desarrollador.
		@include('user.dev')
		@endif

		@if( $user->role == 2)
		Cliente.
		@include('user.client')
		@endif
	</p>
	<p><span style="color: red;">Advertencia:</span> al momento de cambiar el estado de este usuario se perderan todos datos de proyectos y comentarios relacionados con este usuario. Tenga en cuenta esto al momento de editar los roles de los usuarios. Solo se mantendran los datos basicos como el email, el nombre y el contacto de skype.</p>
	<form action="/edit/{{$user->id}}" method="post">
		Nuevo estado: <br>
		<select name="role" id="select" class="selectpicker" required="required" title="Roles" data-header="Selecciona el nuevo rol."> 
			<option value="1" @if($user->isDeveloper() ) selected="selected" @endif> Desarrollador. </option>
			<option value="2" @if($user->isClient() ) selected="selected" @endif> Cliente. </option>
			<option value="0"> Admin. </option>

		</select>	
		{{csrf_field()}}
		<input type="submit" value="Guardar Cambios">
	</form>
</div>

@endsection