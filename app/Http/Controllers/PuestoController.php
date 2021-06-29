<?php

namespace App\Http\Controllers;

use App\Models\Puesto;
use Illuminate\Http\Request;

class PuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('puesto.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $datosPuesto = request()->except(['_token','_method']);
        $datosPuesto['created_at']=now();
        Puesto::insert($datosPuesto);
        return redirect('/area');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function show(Puesto $puesto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        //Se busca en la tabla correspondiente a la clase puesto el id correspondiente y se almacena en $puesto
        $puesto=Puesto::findOrFail($id);
        //Se redirecciona a la vista edit de la carpeta puesto y se le pasan los datos recopilados con la linea anterior
        return view('puesto.edit', compact('puesto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //Se almacenan los datos del request en $datos empleado sin incluir el token del @csrf ni el método que es PATCH
        $datosPuesto = request()->except(['_token','_method']);
        Puesto::where('id','=',$id)->update($datosPuesto);
        //regresa a la vista empleado que por defecto muestra el index
        return redirect('area');
    }

    /**
     * Cambia el estado de 1(activo) a 0(inactivo) para simular su borrado, los datos siguen disponibles en la base de datos
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        //Se almacenan los datos del request en $datos empleado sin incluir el token del @csrf ni el método que es PATCH
        $datosPuesto = request()->except(['_token','_method']);
        Puesto::where('id','=',$id)->update($datosPuesto);
        //regresa a la vista empleado que por defecto muestra el index
        return redirect('area');
    }
}
