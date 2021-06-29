@extends('layouts.app')<!--  Se hereda el layout, esto incluye el login -->

@section('content')<!-- abrimos una seccion y creamos un contenedor -->

    <div class="container">
        <h1>Editar puesto</h1>
        <form action="{{ url('/puesto/'.$puesto->id) }}" method="post">
            @csrf<!-- se manda un token de seguridad -->
            {{ method_field('PATCH') }} <!-- como se van a actualizar datos es necesario que se envíen con un método PATCH -->
            <div class="form-group">
                <label for="Nombre">Nuevo nombre para {{  $puesto->Nombre  }}</label>
                <input type="text" name="Nombre" class="form-control" id="Nombre">
            </div>
            <!-- botón que envía el formulario a la dirección definida en el archivo que usa a esta plantilla -->   
            <input type="submit" class="btn btn-success" value="Cambiar nombre" >
            <!-- Botón para regresar al menú donde se muestran los registros -->
            <a href="{{ url('area/') }}" class="btn btn-primary" >Regresar</a>
        </form>
        
    </div>
@endsection