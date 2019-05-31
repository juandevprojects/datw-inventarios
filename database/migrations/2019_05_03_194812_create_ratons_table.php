<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numero', 20)->nullable($value = true);
            $table->unsignedBigInteger('idmarca');
            $table->foreign('idmarca', 'fk_ratons_marcas')->references('id')->on('marcas')->onDelete('restrict');
            $table->string('modelo', 20)->nullable($value = true);
            $table->unsignedBigInteger('idubicacion');
            $table->foreign('idubicacion', 'fk_ratons_ubicacions')->references('id')->on('ubicacions')->onDelete('restrict');
            $table->string( 'tpraton', 20)->nullable($value = true);
            $table->string('numserie', 25)->nullable($value = true);
            $table->longText('observaciones')->nullable($value = true);
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
        Schema::dropIfExists('ratons');
    }
}
