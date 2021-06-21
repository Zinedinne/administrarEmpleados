@extends('layouts.app')<!--  Se hereda el layout, esto incluye el login -->

@section('content') <!-- abrimos una seccion y creamos un contenedor -->
<div class="container" >
<!-- Se abre una sección de formulario con el método post, que va a mostrar el contenido de la vista form de empleado
la ruta es importante porque indica al formulario la ruta a la que se envía en este caso al método create -->

    <form action="{{  url('/empleado') }}" method="post" enctype="multipart/form-data">
        @csrf<!-- se manda un token de seguridad -->

        @include('empleado.form',['modo'=>'Crear'])<!-- se incluyen los datos del formulario y se define un modo -->

    </form>
</div>

@endsection