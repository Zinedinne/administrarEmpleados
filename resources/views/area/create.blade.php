@extends('layouts.app')<!--  Se hereda el layout, esto incluye el login -->

@section('content')<!-- abrimos una seccion y creamos un contenedor -->
    <div class="container">
        vista para crear areas
        @include('area.form')
    </div>
@endsection