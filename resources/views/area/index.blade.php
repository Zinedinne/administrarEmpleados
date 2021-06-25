@extends('layouts.app')<!--  Se hereda el layout, esto incluye el login -->

@section('content')<!-- abrimos una seccion y creamos un contenedor -->

    <div class="container">
        <form action="{{  url('/area')  }}" method="post">
            @csrf<!-- se manda un token de seguridad -->
            <input type="hidden" name="Estado" value="1"></input><!-- ESTO ES PARA QUE POR DEFECTO SE CREE UN AREA CON ESTADO ACTIVO -->
            <div class="form-group">
                <label for="Nombre">Nombre para nueva área</label>
                <input type="text" name="Nombre" class="form-control" id="Nombre">
            </div>
            <!-- botón que envía el formulario a la dirección definida en el archivo que usa a esta plantilla -->   
            <input type="submit" class="btn btn-success" value=" Crear nueva área" >
        </form>
        <div>
            @foreach( $datos as $dato)
                {{  $dato  }}
            @endforeach
        </div>
        
    </div>
@endsection