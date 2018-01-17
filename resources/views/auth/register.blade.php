@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-2">
      <div class="col-sm-12">
        <h3 class="text-center text-primary">Bienvenido al Registro</h3>
    </div>
    <div class="col-sm-12">
        <form  method="POST" action="{{ route('register') }}" class="">
            <div class="">
                @include('user.crear')

                <div class=" form-row ">
                    <div class="col-sm-6 mx-auto"> 
                        <label for="password" class="">Contraseña</label>
                        <input id="password" type="password" class="form-control @if( $errors->has('password')) is-invalid @endif" name="password" required>
                        @if ( $errors->has('password') )
                        <div class="invalid-feedback">
                            <strong> {{ $errors->first('password') }}</strong>
                        </div>
                        @endif
                    </div>
                </div> 

                <div class=" form-row ">
                    <div class="col-sm-6 mx-auto"> 
                        <label for="password-confirm" class="">Confirma la Contraseña</label>
                        <input id="password-confirm" type="password" class="form-control @if( $errors->has('password_confirmation')) is-invalid @endif" name="password_confirmation" required>
                    </div>
                </div>
                
                <div class="form-row mt-3">
                    <div class="col-sm-6 mx-auto">
                        <button type="submit" class="btn btn-primary">
                            Registrarse
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>
    {{-- <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection
