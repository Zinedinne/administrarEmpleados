<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use App\Models\Puesto;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //
    $datosPuesto['puestos']=Puesto::all();
    $datosArea['areas']=Area::all();
    return view('area.index',compact('datosArea','datosPuesto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //$datosArea = request()->except(['_token','_method']);
        //Area::create($datosArea);
        //return redirect('/area');
        
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
        $datosArea = request()->except(['_token','_method']);
        $datosArea['created_at']=now();
        Area::insert($datosArea);
        return redirect('/area');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        //Se busca en la tabla correspondiente a la clase puesto el id correspondiente y se almacena en $puesto
        $area=Area::findOrFail($id);
        //Se redirecciona a la vista edit de la carpeta puesto y se le pasan los datos recopilados con la linea anterior
        return view('area.edit', compact('area'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //Se almacenan los datos del request en $datos empleado sin incluir el token del @csrf ni el método que es PATCH
        $datosArea = request()->except(['_token','_method']);
        Area::where('id','=',$id)->update($datosArea);
        //regresa a la vista empleado que por defecto muestra el index
        return redirect('area');
    }

    /**
     * Cambia el estado de 1(activo) a 0(inactivo) para simular su borrado, los datos siguen disponibles en la base de datos
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        //Se almacenan los datos del request en $datos empleado sin incluir el token del @csrf ni el método que es PATCH
        $datosArea = request()->except(['_token','_method']);
        Area::where('id','=',$id)->update($datosArea);
        //regresa a la vista empleado que por defecto muestra el index
        return redirect('area');
    }
}
