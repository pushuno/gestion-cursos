<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatedrasCapacitadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catedras_capacitadores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('catedra_id');
            $table->foreign('catedra_id')->references('id')->on('catedras')->onDelete('cascade');
            $table->unsignedBigInteger('capacitador_id');
            $table->foreign('capacitador_id')->references('id')->on('capacitadores')->onDelete('cascade');
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
        Schema::dropIfExists('catedras_capacitadores');
    }
}
