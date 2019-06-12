<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiculoDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculo_detalle', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_vehiculo');
            $table->string('detalle',100);
            $table->string('tipo',100);
            $table->string('descripcion',300)->nullable();
            $table->string('status',10)->default('ACTIVO');
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('id_vehiculo')->references('id')->on('vehiculo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiculo_detalles');
    }
}
