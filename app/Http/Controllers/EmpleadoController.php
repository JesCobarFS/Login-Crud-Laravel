<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $datos['empleados']=Empleado::paginate(1);
        return view('empleados.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleados.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $campos=[
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Correo'=>'required|email',
            'Foto'=> 'required|max:10000|mimes:jpeg,png,jpg'
        ];

        $mensaje=[
            'required' =>'El :atribute es requerido',
            'Foto.required' => 'Lafoto es requerida',
            'Correo.required' =>'Correo requerido'
        ];

        $this->validate($request,$campos,$mensaje);

        //$datosEmpleado = $request->all();
        $datosEmpleado = $request->except('_token');

         
        if($request->hasFile('Foto')){
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');
        }
        Empleado::insert($datosEmpleado);
       
        //return response()->json($datosEmpleado);
         return redirect('empleado')->with('mensaje','Empleado agrgado con exito');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $empleado=Empleado::findOrFail($id);
        return view('empleados.edit',compact('empleado'));
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $campos=[
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Correo'=>'required|email',
            'Foto'=> 'required|max:10000|mimes:jpeg,png,jpg'
        ];

        $mensaje=[
            'required' =>'El :atribute es requerido',
            'Foto.required' => 'Lafoto es requerida',
            'Correo.required' =>'Correo requerido'
        ];

        if($request->hasFile('Foto')){
            $campos=['Foto'=> 'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje=['Foto.required' => 'Lafoto es requerida',  ];
    
        }

        $this->validate($request,$campos,$mensaje);




        $datosEmpleado = $request->except('_token','_method');

        if($request->hasFile('Foto')){
            $empleado=Empleado::findOrFail($id);
            Storage::delete('public/'.$empleado->Foto);
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');
        }


        Empleado::Where('id','=',$id)->update($datosEmpleado);

        $empleado=Empleado::findOrFail($id);
        //return view('empleados.edit',compact('empleado'));
        return redirect('empleado')->with('mensaje','Empleado Actualizado');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {

        if(Storage::delete('public/'.$empleado->Foto)){
            $empleado->delete();
        }

       
     return redirect('empleado')->with('mensaje','Empleado borrado');
    }
}
