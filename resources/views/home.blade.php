@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">

                    @include('debug')

                    @if( Auth::user()->isConfirmed())
                    <div>
                        <a href="/proyecto/Crear/AdmSN">Crear un nuevo proyecto de administracion de redes sociales. </a>
                        <br>
                        <a href="/proyecto/Crear/dossier">Crear un nuevo proyecto dossier. </a>
                        <br>
                        <a href="/proyecto/todo"> Ver todos sus proyectos. </a>
                    </div>
                    @else
                    <p>Hemos notado que tu cuenta no esta verificada, verifiquela <a href="/user/confirmar">ahora.</a></p>
                    <p>Problemas con el correo? Haz click <a href="/user/mail">aqui</a> para recibir el codigo de nuevo.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
