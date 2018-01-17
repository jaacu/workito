@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row my-2">
		<div class="col-sm-12">
			<h3 class="text-center text-primary">Datos del <a href="{{ route('admin.users') }}">Usuario</a>:</h3>
		</div>
		@if( $user->isAdmin() )
		@include('user.admin')
		@endif

		@if( $user->isDeveloper() )
		@include('user.dev')
		@endif

		@if( $user->isClient() )	
		@include('user.client')
		@endif
	</div>	
</div>
@endsection