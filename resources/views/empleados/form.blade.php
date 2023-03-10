<h1>{{ $modo }} Empleado</h1>

@if (count($errors) > 0)

    <div class="alert alert-danger " role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

    @foreach ($errors->all() as $error)
    @endforeach

@endif

<div class="form-group">
    <label for="Nombre"> Nombre</label>
    <input class="form-control" type="text" name="Nombre" id="Nombre" value="{{isset($empleado->Nombre)?$empleado->Nombre:old('Nombre')}}">

</div>

<div class="form-group">
    <label for="ApellidoPaterno">Apellido Paterno</label>
    <input class="form-control" type="text" name="ApellidoPaterno" id="ApellidoPaterno" value="{{isset($empleado->ApellidoPaterno)?$empleado->ApellidoPaterno:old('ApellidoPaterno')}}">

</div>

<div class="form-group">
    <label for="Apellidomaterno">Apellido Materno</label>
    <input class="form-control" type="text" name="ApellidoMaterno" id="ApellidoMaterno" value="{{isset($empleado->ApellidoMaterno)?$empleado->ApellidoMaterno:old('ApellidoMaterno')}}">

</div>

<div class="form-group">
    <label for="Correo">Correo</label>
    <input class="form-control" type="text" name="Correo" id="Correo" value="{{isset($empleado->Correo)?$empleado->Correo:old('Correo')}}">

</div>

<div class="form-group">
    <label for="Correo">Foto</label>
    <input type="file" name="Foto" id="Foto" class="form-control">
    @if (isset($empleado))
        <img class="img-thumbnail img-fluid" src="{{ asset('storage') . '/' . $empleado->Foto }}" alt=""
            width="300">
    @endif


</div>


<input type="submit" value="{{ $modo }} datos" class="btn btn-success">

<a href="{{ url('empleado/') }}" class="btn btn-primary">Regresar</a>
