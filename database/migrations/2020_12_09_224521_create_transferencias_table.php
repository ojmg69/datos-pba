<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transferencias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('distrito_id');
            $table->string('distrito',64);
            $table->float('coparticipacion',15,3)->default(0);
            $table->float('omision_copart_2019',15,3)->default(0);
            $table->float('descentralizacion',15,3)->default(0);
            $table->float('juegos_azar',15,3)->default(0);
            $table->float('ffps',15,3)->default(0);
            $table->float('fsa',15,3)->default(0);
            $table->float('fdo_fort_recursos_muni',15,3)->default(0);
            $table->float('fdo_',15,3)->default(0);
            $table->float('fdo_financ_educativo',15,3)->default(0);
            $table->float('fdo_infra_municipal_2017',15,3)->default(0);

            $table->float('fdo_ley_14890',15,3)->default(0);
            $table->float('total',15,3)->default(0);

            /* $table->timestamps(); */

            /* $table->foreign('distrito_id')->references('id')->on('distritos'); */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transferencias');
    }
}
