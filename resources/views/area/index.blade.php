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

        <br>
           
        <div class="container row col-xs-6 text-center">
                            <!--  TUVE PROBLEMAS PARA IMPRIMIR EL COMPACT ASÍ QUE LO METÍ EN UN SEGUNDO FOREACH Y SÍ FUNCIONÓ  -->
           

            @foreach( $datosArea as $dato)
                @foreach($dato as $dat)
                    @if($dat->Estado) <!--  solo se muestran las áreas con estado activo (con valor 1 en el estado)  -->
                        <table class="table table-light">
                            <thead class="thead-dark text-uppercase">
                                <tr>
                                    <th>{{  $dat->Nombre  }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>
                                        <form action="{{  url('/puesto')  }}"  method="post">
                                            @csrf<!-- se manda un token de seguridad -->
                                            <input type="hidden" name="Estado" value="1"></input><!-- ESTO ES PARA QUE POR DEFECTO SE CREE UN PUESTO CON ESTADO ACTIVO -->
                                            <div class="form-group">
                                                <label for="Nombre">Nombre para nuevo puesto de {{  $dat->Nombre  }}</label>
                                                <input type="text" name="Nombre" class="form-control" id="Nombre">
                                                <input type="hidden" name="area_id" value="{{  $dat->id  }}"></input>
                                            </div>
                                            <!-- botón que envía el formulario a la dirección definida en el archivo que usa a esta plantilla -->   
                                            <input type="submit" class="btn btn-success" value=" Crear nuevo puesto" >
                                            <br><br>
                                        </form>
                                        <a href="{{ url('/area/'.$dat->id.'/edit') }}" class="btn btn-warning"> Editar área </a>
                                        | 
                                        <!-- Se accede al método destroy de PuestoController -->
                                        <form action="{{ url('/area/'.$dat->id) }}" class="d-inline" method="post">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <input type="hidden" name="Estado" value="0"></input><!-- ESTO ES PARA CAMBIAR EL ESTADO DEL EMPLEADO A INACTIVO -->
                                            <input type="submit" onclick="return confirm(¿Quieres borrar?)" class="btn btn-danger" value="Borrar área">
                                        </form>
                                    </th>
                                </tr>
                            </tbody>
                        </table>    

                        <table class="table table-light">                      
                            <thead class="thead-light">
                                <tr>
                                    <th style="width:50%">Puesto</th>
                                    <th style="width:50%">Acciones</th>
                                </tr>
                            </thead>

                            <tbody> 
                                @foreach($datosPuesto as $da)
                                    @foreach($da as $d)
                                        @if(($d->area_id == $dat->id) && $d->Estado )
                                            <tr>
                                                <td>
                                                    {{  $d->Nombre  }}
                                                </td>
                                                <td>   
                                                    <!-- Se accede al método edit de PuestoController -->
                                                
                                                    <a href="{{ url('/puesto/'.$d->id.'/edit') }}" class="btn btn-warning"> Editar puesto </a>
                                                    | 
                                                    <!-- Se accede al método destroy de PuestoController -->
                                                    <form action="{{ url('/puesto/'.$d->id) }}" class="d-inline" method="post">
                                                        @csrf
                                                        {{ method_field('DELETE') }}
                                                        <input type="hidden" name="Estado" value="0"></input><!-- ESTO ES PARA CAMBIAR EL ESTADO DEL EMPLEADO A INACTIVO -->
                                                        <input type="submit" onclick="return confirm(¿Quieres borrar?)" class="btn btn-danger" value="Borrar puesto">
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif    
                                    @endforeach
                                @endforeach                  
                            </tbody>   
                        </table>     

                    @endif    
                @endforeach
            @endforeach
        </div>
        
    </div>
@endsection