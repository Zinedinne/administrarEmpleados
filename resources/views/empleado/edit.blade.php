@extends('layouts.app') <!--  Se hereda el layout, esto incluye el login -->

@section('content') <!-- abrimos una seccion y creamos un contenedor -->
<div class="container">

    <!-- Se abre una sección de formulario que va a mostrar el contenido de la vista form de empleado
    la ruta es importante porque indica al formulario la ruta a la que se envía -->
    <form action="{{ url('/empleado/'.$empleado->id) }}" method="post" enctype="multipart/form-data">
        @csrf  <!-- se manda un token de seguridad -->
        
        {{ method_field('PATCH') }} <!-- como se van a actualizar datos es necesario que se envíen con un método PATCH -->
        
        @include('empleado.form',['modo'=>'Editar'])<!-- se incluyen los datos del formulario y se define un modo -->
    </form>

</div>

@endsection