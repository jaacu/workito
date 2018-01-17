@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8 mx-auto">
            <form method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}
                <div class="form-row">
                    <div class="col-sm-8 text-center mx-auto"> 
                        <label for="email" class="">Correo Electronico:</label>
                        <input id="email" type="email" class="form-control @if( $errors->has('email')) is-invalid @endif" name="email" value="{{ old('email') }}" required autofocus>
                        @foreach($errors->get('email') as $error)
                        <div class="invalid-feedback">
                            <strong> {{ $error }}</strong>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="form-row my-3">
                    <div class="col-md-8 mx-auto">
                        <button type="submit" class="btn btn-primary">
                            Enviar Link Para Restablecer la Contraseña
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
