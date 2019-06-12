<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('central', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('tipo');
            $table->string('latitud');
            $table->string('longitud');
            $table->text('description')->nullable();
            $table->string('status')->default('ACTIVO');
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
        Schema::dropIfExists('central');
    }
}
