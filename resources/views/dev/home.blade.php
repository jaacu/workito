@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class=" mx-auto col-md-12">
            @include('debug')
            <h3 class="text-dark text-center">Bienvenido {{ Auth::user()->name }}</h3>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-sm-8 mx-auto">
            <div class="card border-info ">
                <div class="card-body" >
                    <h5 class="card-title text-center text-capitalize"><a class="text-dark" data-toggle="collapse" href="#proyectos" role="button" aria-expanded="false" aria-controls="proyectos">Proyectos Activos: <span class="text-info">{{ $devs->count() }}</span></a> </h5>
                    <div class="collapse" id="proyectos">
                        <ul class="list-group list-group-flush bg-info ">
                            <li class="list-group-item border-info text-center">
                                <a href="{{ route('dev.proyectos') }}" class="btn btn-primary">Ver Proyectos.</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

{{-- <div class="col-sm-6">
    <div class="card border-info ">
        <div class="card-body" >
            <h5 class="card-title"><a class="text-dark" data-toggle="collapse" href="#usuarios" role="button" aria-expanded="false" aria-controls="usuarios">Usuarios registrados: <span class="text-info">{{ $users->count() }}</span></a> </h5>
            <div class="collapse" id="usuarios">
                <ul class="list-group list-group-flush bg-info ">
                    <li class="list-group-item border-info" >
                        Administradores: <strong><span class="text-info">{{ $users->where('role', 0)->except(['id' => Auth::user()->id])->count() }}</span></strong>
                    </li>
                    <li class="list-group-item border-info">
                        Desarrolladores: <strong><span class="text-info">{{ $users->where('role', 1)->except(['id' => Auth::user()->id])->count() }}</span></strong>
                    </li>
                    <li class="list-group-item border-info" >
                        Clientes: <strong><span class="text-info">{{ $users->where('role', 2)->except(['id' => Auth::user()->id])->count() }}</span></strong>
                    </li>
                    <li class="list-group-item border-info">
                        <a href="{{ route('admin.users') }}" class="btn btn-primary">Ver Usuarios.</a>
                        <a href=" {{route('user.crear.admin') }}" class="btn btn-primary">Crear un nuevo usuario.</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div> --}}
</div>

</div>
@endsection
