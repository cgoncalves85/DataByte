@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card card-primary">
        <div class="card-header">
          Verificación de Datos
        </div>
        <div class="card-body">
          <div align="center">
            <div class="alert alert-success">Usted ya ha Ingresado los Datos Solicitados.</div>
            <br><b>Muchas Gracias !</b>
            <div class="mt-4 mb-4">
              <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Salir') }}</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection