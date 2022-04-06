<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganismosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organismos', function (Blueprint $table) {
            $table->bigIncrements('id');
            /* $table->integer('bloque_id')->nullable();
            $table->integer('departamento_id')->nullable();
            $table->integer('distrito_id')->nullable(); */
            $table->string('distrito',128);
            $table->string('tipo',64)->nullable();
            $table->string('nombre',128);
            $table->string('direccion',128);
            $table->string('horarios',128);
            $table->text('descripcion')->nullable();
            /* $table->text('contacto')->nullable(); */
            $table->string('autoridad',128)->nullable();
            /* $table->string('cargo',128)->nullable();      
            $table->text('imagen')->nullable();      
            $table->string('estado'); */
            
          /*   $table->timestamps(); */

            /* $table->foreign('bloque_id')->references('id')->on('bloques');
            $table->foreign('departamento_id')->references('id')->on('departamentos');
            $table->foreign('distrito_id')->references('id')->on('distritos'); */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organismos');
    }
}