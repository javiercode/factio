<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_importador');
            $table->string('chasis',100);
            $table->string('marca',100);
            $table->string('modelo',100);
            $table->string('color',100);
            $table->string('tipo_auto',100)->nullable();
            $table->string('observacion',300)->nullable();
            $table->string('descripcion',300)->nullable();
            $table->string('status',10)->default('ACTIVO');
            $table->integer('created_by');
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
        Schema::dropIfExists('vehiculos');
    }
}
