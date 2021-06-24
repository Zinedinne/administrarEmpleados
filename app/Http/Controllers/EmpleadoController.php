<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
      * Cuando se redirecciona a la vista empleado por defecto muestra el index
      * Para acceder al resto de métodos es necesario verificar en el route list
      * el tipo de llamado que se debe ejecutar GET, PUT, PATCH 
      */
    public function index()
    {
        //Recibe los datos de la clase objeto se muestran cada 5 registros
        $datos['empleados']=Empleado::paginate(5);
        //Se manda la vista index de la carpeta empleado, también se envía el arreglo con los registros
        return view('empleado.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Muestra la vista create de la carpeta empleado
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //$datosEmpleado = request()->all();


        //A continuación se define el arreglo de campos a validar
        $campos=[
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Correo'=>'required|email'
            ];
        //Se definen los mensajes que se enviará  en caso de que un campo sea requerido
        $mensaje=[
            'required'=>'El :attribute es requerido'
            ];
        //Las fotos tienen características diferentes en el request, por ello hay que manejarlas de manera diferente
        //se verifica que el request tenga un campo Foto y de ser así, se concatenan a los arreglos $campos y $mensaje los requisitos y los mensajes ´para foto
        if($request->hasFile('Foto')){
            $campos=['Foto'=>'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje=['Foto.required'=>'La foto es requerida'];
            }

        //Una vez que se establecieron los arreglos se mandan como parámetros a la función validate
        $this->validate($request,$campos,$mensaje);

        //Ya validados los datos, se crea un arreglo con los datos del request, excluyendo al token que genera el @csrf
        $datosEmpleado = request()->except('_token');
        $datosEmpleado['created_at']=now();

        //Si en el request hay un campo Foto se va a almacenar en la dirección /public/uploads del Storage de la app
        if($request->hasFile('Foto')){
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');
            }

        //Se usa el método insert para almacenar los datos en la tabla correspondiente a la clase Empleado
        Empleado::insert($datosEmpleado);
        //return response()->json($datosEmpleado);//cadena json de prueba para verificar que los datos se almacenaron
        //redireccionamos a la vista empleado, que por defecto nos muestra el index
        return redirect('empleado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $empleado=Empleado::findOrFail($id);
        return view('empleado.watch', compact('empleado'));//se muestran los datos actualizados
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        //Se busca en la tabla correspondiente a la clase empleado el id correspondiente y se almacena en $empleado
        $empleado=Empleado::findOrFail($id);
        //Se redirecciona a la vista edit de la carpeta empleado y se le pasan los datos recopilados con la linea anterior
        return view('empleado.edit', compact('empleado'));
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
        //Se almacenan los datos del reques en $datos empleado sin incluir el token del @csrf ni el método que es PATCH
        $datosEmpleado = request()->except(['_token','_method']);

        //Si se va a actualizar una foto, primero se elimina la foto anterior del storage
        if($request->hasFile('Foto')){
            $empleado=Empleado::findOrFail($id);//se busca
            Storage::delete('public/'.$empleado->Foto);//se elimina
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');//se actualiza
            }
        //Se actualizan los campos en la base de datos
        Empleado::where('id','=',$id)->update($datosEmpleado);
        $empleado=Empleado::findOrFail($id);//se recuperan los datos actualizados
        return view('empleado.edit', compact('empleado'));//se muestran los datos actualizados

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */

      
     /*ESTA FUNCION BORRA DIRECTAMENTE DE LA BASE DE DATOS
    public function destroy($id)
    {
        //Dentro de la tabla correspondiente a la tabla empleado se busca el id que coincida y se almacena en empleado
        $empleado=Empleado::findOrFail($id);
         
        //si es posible eliminar del storage la foro correspondiente al registro entonces elimina el registro
        if(Storage::delete('public/'.$empleado->Foto)){
            Empleado::destroy($id);
            }
            
        


        //regresa a la vista empleado que por defecto muestra el index
        return redirect('empleado');
    }
    */

    //EN VEZ DE BORRAR DIRECTAMENTE DE LA BASE DE DATOS SE CAMBIA SU ESTADO A INACTIVO
    public function destroy(Request $request, $id)
    {
        //Se almacenan los datos del reques en $datos empleado sin incluir el token del @csrf ni el método que es PATCH
        $datosEmpleado = request()->except(['_token','_method']);
        //Se actualizan los campos en la base de datos
        Empleado::where('id','=',$id)->update($datosEmpleado);
        //regresa a la vista empleado que por defecto muestra el index
        return redirect('empleado');
    
    }
}
