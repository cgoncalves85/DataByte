@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card card-primary">
        <div class="card-header">
          Modificar Datos del Usuario
        </div>
        <div class="card-body">
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
              </ul>
            </div><br />
          @endif
          <form method="post" action="{{ route('datos.update', $datos->id) }}" accept-charset="UTF-8" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  @csrf
                  @method('PATCH')
                  <label for="nombre">Nombre :</label>
                  <input type="text" class="form-control" name="nombre" value="{{ $datos->nombre }}"/>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="apellido">Apellidos :</label>
                  <input type="text" class="form-control" name="apellido" value="{{ $datos->apellido }}"/>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="email">Correo Electrónico :</label>
                  <input type="text" class="form-control" name="email" value="{{ $datos->email }}"/>
                </div>
              </div>             
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="telefono">Teléfono :</label>
                  <input type="text" class="form-control" name="telefono" value="{{ $datos->telefono }}"/>
                </div>
              </div>

              <div class="col-md-8">
                <div class="form-group">
                  <label for="imagen">Imágen :</label>
                  <input type="file" class="m-4" name="imagen">
                </div> 
              </div>
            </div>
                                   
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="descripcion">Descripción :</label>
                  <textarea rows="5" columns="5" class="form-control" name="descripcion">{{ $datos->descripcion }}</textarea>
                </div>
              </div>
              
              <div align="right" class="col-md-12 mt-4 mb-4">
                <div class="row">
                  <div class="col-md-10" align="right">
                    <button type="submit" class="btn btn-primary">Guardar Datos</button>
                  </div>
                  <div class="col-md-2">
                    <a href="{{ route('datos.index') }}" class="btn btn-danger">Cancelar</a>
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