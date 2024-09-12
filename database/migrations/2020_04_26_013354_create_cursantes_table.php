<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->date('fecha_nacimiento');
            $table->date('fecha_ingreso');
            $table->bigInteger('numero_documento')->unique();
            $table->unsignedBigInteger('nivel_estudio_id');
            $table->foreign('nivel_estudio_id')->references('id')->on('nivel_estudios');
            $table->string('titulo')->nullable();
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();
            $table->unsignedBigInteger('sector_id');
            $table->foreign('sector_id')->references('id')->on('sectores');
            $table->string('direccion')->nullable(); //direccion a la que pertenece el cursante
            $table->integer('categoria')->nullable();
            $table->integer('afiliado')->nullable();
            $table->integer('afiliado_barra')->nullable();
            $table->integer('legajo')->nullable();
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
        Schema::dropIfExists('cursantes');
    }
}
