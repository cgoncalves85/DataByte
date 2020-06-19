@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('R.D Users - Resetear Contraseña') }}</div>

                <div class="card-body mt-2">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo Electrónico') }}</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0 mt-4 mb-4">
                            <div class="col-md-8 offset-md-4">
                                <div class="row">
                                    <div class="col-md-8">                               
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Resetear Contraseña') }}
                                        </button>
                                    </div>

                                    <div class="col-md-4">
                                        @if (Route::has('login'))
                                            <a href="{{ route('login') }}" class="btn btn-danger">Cancelar</a>
                                        @endif 
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
