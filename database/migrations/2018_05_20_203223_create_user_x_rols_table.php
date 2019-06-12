<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserXRolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('core')->create('user_x_rol', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->integer('id_rol');
            $table->string('status',10)->default('ACTIVO');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('user');
            $table->foreign('id_rol')->references('id')->on('rol');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('user_x_rols');
    }
}
