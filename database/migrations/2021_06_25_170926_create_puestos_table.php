<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puestos', function (Blueprint $table) {
            $table->id();

            $table->string('Nombre');
            $table->integer('Estado');
            $table->unsignedBigInteger('area_id'); 
            $table->foreign('area_id')->references('id')->on('area'); 
            /*TUVE PROBLEMAS PARA CREAR LA CLAVE FORÁNEA, AL EJECUTAR LA MIGRACIÓN SOLO CREO LA TABLA
            *PERO NO HIZO EL ENLACE DE LA CLAVE, LO TUVE QUE HACER MANUALMENTE DESDE PHPMYADMIN
            */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('puestos');
    }
}
