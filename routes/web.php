<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\PuestoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Esta ruta es para que la raiz me redireccione a la vista welcome (va a ser mi landing page)
Route::get('/', function () {  
    return view('welcome');         
    });

//Esta ruta es para que solo se puedan acceder a las rutas de la clase empleado por medio autenticación
Route::resource('empleado', EmpleadoController::class)->middleware('auth');

//Esto es para definir las rutas para acceder al controlador de area
Route::resource('area', AreaController::class)->middleware('auth');

//Esto es para definir las rutas para acceder al controlador de puestos
Route::resource('puesto', PuestoController::class)->middleware('auth');


Auth::routes();

//esta ruta accede al método index de EmpleadoController
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//define la ruta home como la ruta por defecto después de la autenticación
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [EmpleadoController::class, 'index'])->name('home');
    });