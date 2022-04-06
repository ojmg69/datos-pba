<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoliticosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('politicos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->integer('seccion_id');
          /*   $table->bigIncrements('departamento_id'); */
            
            
            $table->bigInteger('poblacion')->default(0);
            $table->double('km2',10,3)->default(0);
            $table->double('densidad',10,3)->default(0);
            $table->string('intendente')->nullable();
            /* $table->text('imagen')->nullable(); */
            /* $table->string('estado')->default('ACTIVO');
            $table->timestamps(); */

            $table->foreign('seccion_id')->references('id')->on('secciones');
            /* $table->foreign('departamento_id')->references('id')->on('departamentos'); */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('politicos');
    }
}
