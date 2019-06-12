<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name',100);
            $table->string('second_name',100)->nullable();
            $table->string('first_lastname',100);
            $table->string('second_lastname',100)->nullable();
            $table->integer('ci');
            $table->string('complement_ci',3)->nullable();
            $table->string('extencion_ci',3);
            $table->string('gender',10);
            $table->date('birthday')->nullable();
            $table->string('country',100)->nullable();
            $table->string('departament',100)->nullable();
            $table->text('addresss')->nullable();
            $table->string('prymary_phone',50)->nullable();
            $table->integer('cell_phone')->nullable();
            $table->string('photo_format',100)->nullable();
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
        //
    }
}
