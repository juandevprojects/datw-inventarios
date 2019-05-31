<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numero', 20)->nullable($value = true);
            $table->unsignedBigInteger('idmarca');
            $table->foreign('idmarca', 'fk_monitors_marcas')->references('id')->on('marcas')->onDelete('restrict');
            $table->string('modelo', 20)->nullable($value = true);
            $table->unsignedBigInteger('idubicacion');
            $table->foreign('idubicacion', 'fk_monitors_ubicacions')->references('id')->on('ubicacions')->onDelete('restrict');
            $table->string( 'tpmon', 20)->nullable($value = true);
            $table->string('numserie', 25)->nullable($value = true);
            $table->string( 'tamano', 20)->nullable($value = true);
            $table->longText('observaciones')->nullable($value = true);
            $table->boolean('tienedvi')->default(false);
            $table->boolean('tienehdmi')->default(false);
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
        Schema::dropIfExists('monitors');
    }
}
