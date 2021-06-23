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
                @if($empleado->Estado)<!-- SOLO SE MUESTRAN LOS EMPLEADOS CON ESTADO ACTIVO -->
                    <tr>
                        <!-- <td>{{ $empleado->id }}</td>  -->

                        <td>
                        <img src="{{ asset('storage'.'/'.$empleado->Foto) }}" width="100" alt="">
                        </td>

                        <td>{{ $empleado->Nombre }} {{ $empleado->ApellidoPaterno }} {{ $empleado->ApellidoMaterno }}</td>
                        <td>{{ $empleado->Correo }}</td>
                        <td>
                            <!-- Se accede al método show de EmpleadoController -->
                            <a href="{{ url('/empleado/'.$empleado->id.'/edit') }}" class="btn btn-primary"> Ver </a>
                            |
                            <!-- Se accede al método edit de EmpleadoController -->
                            <a href="{{ url('/empleado/'.$empleado->id.'/edit') }}" class="btn btn-warning"> Editar </a>
                            | 
                            <!-- Se accede al método destroy de Empleado.controller -->
                            <form action="{{ '/sistema/public/empleado/'.$empleado->id }}" class="d-inline" method="post">
                                @csrf
                                {{ method_field('DELETE') }}
                                <input type="hidden" name="Estado" value="0"></input><!-- ESTO ES PARA CAMBIAR EL ESTADO DEL EMPLEADO A INACTIVO -->
                                <input type="submit" onclick="return confirm(¿Quieres borrar?)" class="btn btn-danger" value="Borrar">
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>

    </table>

    <div class="container"><!-- contenedor para alinear el paginador -->
        <div class="row justify-content-center">
            {!! $empleados->links() !!} <!-- esta línea es para el paginate definido en el controlador -->
        </div>
    </div>

</div>

@endsection


