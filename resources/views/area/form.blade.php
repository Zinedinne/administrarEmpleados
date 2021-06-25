vista de formulario para areas
<form action="{{  url('/empleado') }}" method="post" enctype="multipart/form-data">
    @csrf<!-- se manda un token de seguridad -->
    <input type="hidden" name="Estado" value="1"></input><!-- ESTO ES PARA QUE POR DEFECTO SE CREE UN AREA CON ESTADO ACTIVO -->

    <div class="form-group">
        <label for="Nombre">Nombre</label>
        <input type="text" name="Nombre" class="form-control" id="Nombre">
    </div>
    
    
    <!-- botón que envía el formulario a la dirección definida en el archivo que usa a esta plantilla -->   
    <input type="submit" class="btn btn-success" value=" datos" >
    <!-- Botón para regresar al menú donde se muestran los registros -->
    <a href="{{ url('area/') }}" class="btn btn-primary" >Regresar</a>

</form>