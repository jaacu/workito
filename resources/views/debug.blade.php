@forelse($errors->all() as $error)
@if( $loop->first)
<div class="alert alert-danger" role="alert">
	<h3 class="alert-heading ml-2">Parece ser que hay algunos errores!</h3>
	@endif
	<p>{{ $error}}</p>
	@if( $loop->last)
</div>
@endif
@empty
{{-- <h4 style="color: blue;">No hay errores.</h4> --}}
@endforelse