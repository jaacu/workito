@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Bienvenido a la developers Home Page</div>

                <div class="panel-body">
                    {{-- @if (session('success'))
                    <div style="color: green;">
                        {{ session('success') }}
                    </div>
                    @endif --}}
                    
                    @include('debug')
                    
                    <p><a href="/dev/proyectos">Aqui salen todos tus proyectos.</a></p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
