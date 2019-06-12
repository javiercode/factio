<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParDominiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('par_dominio', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dominio',150);
            $table->string('codigo',50);
            $table->string('detalle',300);
            $table->string('tipo',100)->nullable();
            $table->string('descripcion',300)->nullable();
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
        Schema::dropIfExists('par_dominio');
    }
}
