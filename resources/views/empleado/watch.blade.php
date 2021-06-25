@extends('layouts.app')<!--  Se hereda el layout, esto incluye el login -->

@section('content')<!-- abrimos una seccion y creamos un contenedor -->
<div class="container">
    <!-- Botón para ir a la vista  create  -->
    <a href="{{ url('empleado/create') }}" class="btn btn-success">Registrar empleado</a>
    <br/>
    <br/>


    {{  $empleado  }}
    <!-- se crea una tabla para mostrar los datos de los registros -->
    <div class="container">
        <div class="container">
            <div class="container">  <!-- Estos div son para reducir el tamaño de la tabla que se muestra -->
                <div class="container row col-xs-6 text-center">
                    <table class="table table-light">
                        <thead class="thead-light">
                            <tr>
                            <!-- <th>#</th>  VAMOS A EVITAR MOSTRAR EL ID AL USUARIO-->
                                <th>Campo</th>
                                <th>Dato</th>
                            </tr>
                        </thead>

                        <tbody> 
                            <tr >
                                <!-- <td>{{ $empleado->id }}</td>  -->
                                <td>Foto</td>
                                <td>
                                    <img  name="ApellidoPaterno" src="{{ asset('storage'.'/'.$empleado->Foto) }}" width="100" alt="">
                                </td>                           
                            </tr>
                            <tr>
                                <td>Nombre</td>
                                <td>{{ $empleado->Nombre }} {{ $empleado->ApellidoPaterno }} {{ $empleado->ApellidoMaterno }}</td>
                                
                            </tr>
                            <tr>
                                <td>Correo</td>
                                <td>{{ $empleado->Correo }}</td> 
                            </tr>
                            <tr>
                                <td>Antigüedad</td>
                                <td>{{ $empleado->created_at->diffForHumans() }}</td> 
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>    
    </div>
    

        
        
    <!-- Botón para regresar al menú donde se muestran los registros -->
    <a href="{{ url('empleado/') }}" class="btn btn-primary" >Regresar</a>
</div>

@endsection