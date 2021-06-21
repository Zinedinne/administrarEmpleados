@extends('layouts.app')<!--  Se hereda el layout, esto incluye el login -->

@section('content')<!-- abrimos una seccion y creamos un contenedor -->
<div class="container">
    <!-- Botón para ir a la vista  create  -->
    <a href="{{ url('empleado/create') }}" class="btn btn-success">Registrar empleado</a>
    <br/>
    <br/>
    <!-- se crea una tabla para mostrar los datos de los registros -->
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
            <!-- <th>#</th>  VAMOS A EVITAR MOSTRAR EL ID AL USUARIO-->
                <th>Foto</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach( $empleados as $empleado)
            <tr>
                <!-- <td>{{ $empleado->id }}</td>  -->

                <td>
                <img src="{{ asset('storage'.'/'.$empleado->Foto) }}" width="100" alt="">
                </td>

                <td>{{ $empleado->Nombre }} {{ $empleado->ApellidoPaterno }} {{ $empleado->ApellidoMaterno }}</td>
                <td>{{ $empleado->Correo }}</td>
                <td>
                    <!-- Se accede al método edit de EmpleadoController -->
                    <a href="{{ url('/empleado/'.$empleado->id.'/edit') }}" class="btn btn-warning"> Editar </a>
                    | 
                    <!-- Se accede al método destroy de Empleado.controller -->
                    <form action="{{ '/sistema/public/empleado/'.$empleado->id }}" class="d-inline" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                        <input type="submit" onclick="return confirm(¿Quieres borrar?)" class="btn btn-danger" value="Borrar">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>


    {!! $empleados->links() !!} <!-- esta línea es para el paginate definido en el controlador -->


</div>

@endsection


