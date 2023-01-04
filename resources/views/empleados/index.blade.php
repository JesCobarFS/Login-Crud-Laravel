@extends('layouts.app')

@section('content')
<div class="container">


 @if (Session::has('mensaje'))
<div class="alert alert-success alert-dismissible " role="alert">
   
    {{Session::get('mensaje')}}
    
    
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        
    </button>
  </div>
@endif
<a href="{{url('empleado/create')}}" class="btn btn-success">Registrar nuevo empleado</a>
<br>
<br>
<table class="table table-light">

    <!--Cabecera-->
    <thead class="theadllight">
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Correo</th>
            <th>Fotografia</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <!--Cuerpo-->
    <tbody>
        @foreach (  $empleados as $empleado)
    
        <tr>
            <td>{{$empleado->id}}</td>
            <td>{{$empleado->Nombre}}</td>
            <td>{{$empleado->ApellidoPaterno}}</td>
            <td>{{$empleado->ApellidoMaterno}}</td>
            <td>{{$empleado->Correo}}</td>
            <td>
              
                <img src="{{asset('storage').'/'.$empleado->Foto}}" alt="" width="250" class="img-thumbnail img-fluid">
            </td>
            <td>
                <a href="{{url('empleado/'.$empleado->id.'/edit')}}" class="btn btn-warning" >
                Editar 
                </a>
                <form method="POST"  action="{{route('empleado.destroy', $empleado)}}" class="d-inline">
                    @method('DELETE')
                @csrf
                
                <input type="submit" onclick="return confirm('¿Quieres borrar?')" value="borrar" class="btn btn-danger">
                </form>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>

{!!$empleados->links()!!}
</div>
@endsection