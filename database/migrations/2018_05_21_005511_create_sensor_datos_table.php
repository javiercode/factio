<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensorDatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensor_dato', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_sensor');
            $table->decimal('valor',20)->nullable();
            $table->string('estado',100);
            $table->string('tipo',100)->nullable();
            $table->string('descripcion',300)->nullable();
            //$table->timestamp('fecha')->default('CURRENT_TIMESTAMP');
			$table->dateTime('fecha')->nullable();
            $table->string('status',10)->default('ACTIVO');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('sensor_datos');
    }
}
