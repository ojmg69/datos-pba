<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSenadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('senadores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('bloque_id')->nullable();
            $table->integer('departamento_id')->nullable();
            $table->integer('seccion_id')->nullable();
            $table->integer('distrito_id')->nullable();
            $table->string('nombre',64);
            $table->timestamp('mandato_desde')->nullable();
            $table->timestamp('mandato_hasta')->nullable();
            $table->text('descripcion')->nullable();
            $table->text('imagen')->nullable();
            $table->text('contacto')->nullable();
            $table->string('estado',20)->default('ACTIVO');
            $table->timestamps();

            $table->foreign('distrito_id')->references('id')->on('distritos');
            $table->foreign('bloque_id')->references('id')->on('bloques');
            $table->foreign('departamento_id')->references('id')->on('departamentos');
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
        Schema::dropIfExists('senadors');
    }
}
