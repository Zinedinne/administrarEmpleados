<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEstadoToEmpleados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empleados', function (Blueprint $table) {
            //
            $table->integer('Estado')->after('Foto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

     /**
      * Esta migracion es para agregar el campo Estado a la tabla empleados
      *se va a agregar después del campo Foto
      */
    public function down()
    {
        Schema::table('empleados', function (Blueprint $table) {
            //
        });
    }
}
