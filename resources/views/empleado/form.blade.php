<!--  este archivo es una plantilla de formulario que se utiliza para crear y editar
 recibe un modo que se define antes de insertar esta vista -->
<h1>{{ $modo }} empleado</h1> 


<!-- Si al enviar el formulario existen errores en la validación se muestra un mensaje con los errores, esta validación se hace en el controlador -->
@if(count($errors)>0)
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- se crean etiquetas con los campos y nombre que se necesitan
 para la sección editar, si ya existen valores entonces se mostrarán los datos  -->
<div class="form-group">
    <label for="Nombre">Nombre</label>
    <input type="text" name="Nombre" class="form-control" value="{{ isset($empleado->Nombre)?$empleado->Nombre:old('Nombre') }}" id="Nombre">
</div>
<div class="form-group">
    <label for="ApellidoPaterno">Apellido Paterno</label>
    <input type="text" class="form-control" name="ApellidoPaterno" value="{{ isset($empleado->ApellidoPaterno)?$empleado->ApellidoPaterno:old('ApellidoPaterno') }}"id="ApellidoPaterno">
</div>
<div class="form-group">
    <label for="ApellidoMaterno">Apellido Materno</label>
    <input type="text" class="form-control" name="ApellidoMaterno" value="{{ isset($empleado->ApellidoMaterno)?$empleado->ApellidoMaterno:old('ApellidoMaterno') }}" id="ApellidoMaterno">
</div>
<div class="form-group">
    <label for="Correo">Correo</label>
    <input type="text" class="form-control" name="Correo" value="{{ isset($empleado->Correo)?$empleado->Correo:old('Correo') }}" id="Correo">
</div>
<div class="form-group">
    <label for="Foto"></label>
    <!-- para recuperar la foto es necesario revisar el sotarge -->
    @if(isset($empleado->Foto)) 
        <img src="{{ asset('storage'.'/'.$empleado->Foto) }}" width="100" alt="">
    @endif
    <input type="file" name="Foto" class="form-control" value="" id="Foto">
</div>    
<!-- botón que envía el formulario a la dirección definida en el archivo que usa a esta plantilla -->   
<input type="submit" class="btn btn-success" value="{{ $modo }} datos" >
<!-- Botón para regresar al menú donde se muestran los registros -->
<a href="{{ url('empleado/') }}" class="btn btn-primary" >Regresar</a>