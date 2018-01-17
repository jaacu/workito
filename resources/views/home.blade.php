@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 my-3">
            <h3 class="text-center">
                Bienvenido <strong class="text-capitalize">{{ Auth::user()->name }}</strong>!
            </h3>
        </div>
        @if( ! Auth::user()->isConfirmed())
        <div class="col-sm-12 my-3">
            <div class="aler alert-warning p-2">
                <br>
                <hr>
                <h4 class="alert-heading text-center">
                    Aun no has verificado tu cuenta, verificala <a class="alert-link" href="{{ route('user.confirmar') }}">ahora</a>.
                </h4>
                <h6 class="text-center">
                    No has recibido ningun correo? <a class="alert-link" href="{{ route('user.mail') }}">Reenviar correo</a>.
                </h6>
                <hr>
                <br>
            </div>
        </div>
        @else
        <div class="col-sm-8 my-3 mx-auto">
            <div class="card border-info ">
                <div class="card-body" >
                    <h5 class="card-title text-center text-capitalize"><a class="text-dark" data-toggle="collapse" href="#proyectos" role="button" aria-expanded="false" aria-controls="proyectos">Proyectos Creados: <span class="text-info">{{ Auth::user()->getProyects()->count() }}</span></a> </h5>
                    <div class="collapse" id="proyectos">
                        <ul class="list-group list-group-flush bg-info ">
                            <li class="list-group-item border-info text-center">
                                Dossiers <strong><span class="text-info">{{ Auth::user()->dossiers->count() }}</span></strong> <br>
                                <a href="{{ route('proyecto.dossier.crear') }}" class="btn btn-outline-primary">
                                    Crear un nuevo proyecto!
                                </a>
                            </li>
                            <li class="list-group-item border-info text-center">
                                Administracion De Redes Sociales <strong><span class="text-info">{{ Auth::user()->adminSocialNetworks->count() }}</span></strong><br>
                                <a href="{{ route('proyecto.adminSocialNetworks.crear') }}" class="btn btn-outline-primary">
                                    Crear un nuevo proyecto!
                                </a>
                            </li>
                            <li class="list-group-item border-info text-center">
                                <a href="{{ route('proyecto.all') }}" class="btn btn-primary">Ver Todos Los Proyectos</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

             {{-- <a href="/proyecto/Crear/AdmSN">Crear un nuevo proyecto de administracion de redes sociales. </a>
                    <br>
                    <a href="/proyecto/Crear/dossier">Crear un nuevo proyecto dossier. </a>
                    <br>
                    <a href="/proyecto/todo"> Ver todos sus proyectos. </a> --}}
