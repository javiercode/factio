<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_sensor');
            $table->integer('id_entrada');
            $table->integer('id_salida')->nullable();
            $table->integer('id_vehiculo')->nullable();
            $table->string('estado',50)->default('ABIERTO');
            $table->string('status',10)->default('ACTIVO');
            $table->string('detalle',200)->nullable();
            $table->string('observacion',300)->nullable();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('id_sensor')->references('id')->on('sensor');
            $table->foreign('id_entrada')->references('id')->on('sensor_dato');
            $table->foreign('id_salida')->references('id')->on('sensor_dato');
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
        Schema::dropIfExists('asignacions');
    }
}
