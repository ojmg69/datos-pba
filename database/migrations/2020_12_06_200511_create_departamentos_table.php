<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartamentosTable extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departamentos', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('seccion_id');
            $table->string('nombre');
            $table->string('cabecera');
            $table->string('estado')->default('ACTIVO');
            $table->timestamps();

            $table->primary('id');
            $table->foreign('seccion_id')->references('id')->on('secciones');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departamentos');
    }
}