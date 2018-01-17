@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row my-3">
    @include('debug')
    <div class="col-sm-12 my-4">
      <h3 class="text-center">
        <a href="{{ route('proyecto.show', $proyecto->id) }}" class="text-dark">
          {{ $proyecto->nombre }}
        </a>
      </h3>
    </div>
    @if(  $proyecto->isTerminado() )
    <div class="col-sm-12 mx-auto">
      <div class="alert alert-success my-3">
        <hr>
        <h3 class="alert-heading text-center">
          Este proyecto ya ha sido terminado!
        </h3>
        <hr>
      </div>
      @include('comments.comentariosProyecto')
    </div>
    @else
    <div id="expiredBox" class=" d-none col-sm-12 text-center alert alert-danger">
      <h5 id="expired" class="alert-heading">
      </h5>
    </div>
    <div class="col-sm-12 text-center">
      <h4>Tiempo restante para la fecha limite de entrega:</h4>
      <h4 id="limite">
      </h4>
    </div>

    @if( Auth::user()->isDeveloper() )
    <div class="col-sm-12 text-center my-3">
      <button id="boton" autofocus class="btn btn-success btn-lg w-50 my-2">Comenzar a trabajar</button>
      <h4 class="text-info my-2">Tiempo trabajado:</h4>
      <h5 class=" text-dark" id="trabajado"></h5>
    </div>
    @endif

    <div class="col-sm-12">
      <form action="{{ route('proyecto.comentar', $proyecto->id) }}" method="post">
        {{ csrf_field() }}
        <div class="form-row">
          <div class="col-sm-6 mx-auto text-center">
            <h4>Dejar un comentario:</h4>
            <textarea class="form-control" name="texto" id="texto" cols="50" rows="4" placeholder="Comentario" required="required" @if(Auth::user()->isAdmin()) autofocus @endif>
            </textarea>
            <br>
          </div>
        </div>
        <div class="form-row">
          <div class="col-sm-12 text-center">
            <button type="submit" class="btn btn-outline-success">Guardar comentario.</button>
          </div>
        </div>
      </form>
    </div>
    <div class="col-sm-12 mx-auto">
      @include('comments.comentariosProyecto')
    </div>
    @endif
  </div>
</div>
@endsection
