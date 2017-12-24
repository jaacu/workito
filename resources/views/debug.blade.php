@forelse($errors->all() as $error)
@if( $loop->first)
<h3 style="color: red;" >Errores: </h3>
@endif
<p style="color: red;">{{ $error}}</p>
@empty
<h4 style="color: blue;">No hay errores.</h4>
@endforelse