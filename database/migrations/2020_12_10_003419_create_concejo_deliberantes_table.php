<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConcejoDeliberantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concejo_deliberantes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('partido');
            $table->string('concejal');
            $table->integer('mandato_inicio');
            $table->integer('mandato_fin');
            $table->string('bloque');
            /* $table->timestamps(); */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('concejo_deliberantes');
    }
}
