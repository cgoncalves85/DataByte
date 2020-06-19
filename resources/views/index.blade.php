@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card card-primary">
        <div class="card-header">
          Listado de Datos
        </div>
        <div class="card-body">
          @if(session()->get('success'))
            <div class="alert alert-success">
              {{ session()->get('success') }}  
            </div><br />
          @endif
          <table class="table table-striped table-bordered mt-2">
            <thead>
                <tr>
                  <th>Nombres</th>
                  <th>Apellidos</th>
                  <th>Correo Electrónico</th>
                  <th>Teléfono</th>
                  <th>Imágen</th>
                  <th>Descripción</th>
                  <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($datos as $dato)
                <tr>
                    <td>{{$dato->nombre}}</td>
                    <td>{{$dato->apellido}}</td>
                    <td>{{$dato->email}}</td>
                    <td>{{$dato->telefono}}</td>
                    <td>{{$dato->imagen}}</td>
                    <td>{{$dato->descripcion}}</td>
                    <td width="5%"><a href="{{ route('datos.edit', $dato->id)}}" class="btn btn-primary">Editar</a></td>
                    <td width="5%">
                        <form action="{{ route('datos.destroy', $dato->id)}}" method="post">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
          {{ $datos->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection