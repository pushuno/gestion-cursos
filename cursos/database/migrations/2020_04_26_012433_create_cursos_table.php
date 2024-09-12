<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->unsignedBigInteger('metodologia_id');
            $table->foreign('metodologia_id')->references('id')->on('metodologias');
            $table->unsignedBigInteger('eje_id');
            $table->foreign('eje_id')->references('id')->on('ejes');
            $table->string('duracion_leyenda');
            $table->unsignedBigInteger('duracion_horas');
            $table->boolean('eliminado')->default(false);
            /*$table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('usuarios');*/
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
        Schema::dropIfExists('cursos');
    }
}
