@extends('layouts.app')

@section('content')
<div class="container">

<!--<form action="{{url('/empleado/'.$empleado->id)}}" method="POST" enctype="multypart/form-data">-->
<form action="{{route('empleado.update',$empleado->id)}}" method="POST" enctype="multipart/form-data">
@include('empleados.form',['modo'=>'Editar'])
@method('PATCH')
@csrf
<!--{{method_field('PATCH')}}-->
</form>
</div>
@endsection