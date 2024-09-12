<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCapacitadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capacitadores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->date('fecha_nacimiento');
            $table->bigInteger('numero_documento')->nullable();
            $table->unsignedBigInteger('nivel_estudio_id');
            $table->foreign('nivel_estudio_id')->references('id')->on('nivel_estudios');
            $table->string('titulo')->nullable();
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();
            $table->unsignedBigInteger('sector_id')->nullable();
            $table->foreign('sector_id')->references('id')->on('sectores');
            $table->integer('legajo')->nullable();
            $table->string('oficina')->nullable(); //oficina a la que pertenece el capacitador
            $table->integer('categoria')->nullable();
            $table->integer('afiliado')->nullable();
            $table->integer('afiliado_barra')->nullable();
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
        Schema::dropIfExists('capacitadores');
    }
}
