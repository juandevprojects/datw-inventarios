<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImpresorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('impresoras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numero', 20)->nullable($value = true);
            $table->unsignedBigInteger('idmarca');
            $table->foreign('idmarca', 'fk_impresoras_marcas')->references('id')->on('marcas')->onDelete('restrict');
            $table->string('modelo', 20)->nullable($value = true);
            $table->unsignedBigInteger('idubicacion');
            $table->foreign('idubicacion', 'fk_impresoras_ubicacions')->references('id')->on('ubicacions')->onDelete('restrict');
            $table->string( 'tpimpresora', 20)->nullable($value = true);
            $table->string('numserie', 25)->nullable($value = true);
            $table->string( 'red', 25)->nullable($value = true);
            $table->integer('memoria')->nullable($value = true);
            $table->boolean( 'serie')->default(false);
            $table->boolean( 'usb')->default(false);
            $table->boolean( 'wifi')->default(false);
            $table->boolean( 'paralelo')->default(false);
            $table->boolean( 'ethernet')->default(false);
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
        Schema::dropIfExists('impresoras');
    }
}
