<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoftPcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soft_pcs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idpc');
            $table->foreign('idpc', 'fk_softpcs_ordenadors')->references('id')->on('ordenadors')->onDelete('restrict');
            $table->unsignedBigInteger('idsoft');
            $table->foreign('idsoft', 'fk_softpcs_softwares')->references('id')->on('softwares')->onDelete('restrict');
            $table->date('fechainst')->nullable($value = true);
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
        Schema::dropIfExists('soft_pcs');
    }
}
