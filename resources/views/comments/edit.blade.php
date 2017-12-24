@extends('layouts.app')

@section('content')

@include('debug')
<p>Comentario hecho en el proyecto: "{{ $comment->proyect->nombre }}"</p>
<p>Creado: {{ $comment->forHumansCreado() }}</p>
@if( $comment->isEditado() )
<p>Ultima vez editado: {{ $comment->forHumansEditado() }}</p>
@endif
<form action="/comentario/edit/{{$comment->id}}" method="post">
  {{ csrf_field() }}
  <textarea name="texto" id="texto" cols="50" rows="3" placeholder="Comentario editado" autofocus="autofocus" required="required">{{ $comment->texto}}</textarea><br>
  <input type="submit" class="btn btn-success" value="Guardar Cambios.">
</form>
@endsection