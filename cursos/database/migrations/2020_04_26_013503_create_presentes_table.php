<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presentes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fecha_id');
            $table->foreign('fecha_id')->references('id')->on('fechas');
            $table->unsignedBigInteger('cursante_id');
            $table->foreign('cursante_id')->references('id')->on('cursantes')->onDelete('cascade');
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users');
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
        Schema::dropIfExists('presentes');
    }
}
