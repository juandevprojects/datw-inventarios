<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoftwaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('softwares', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcion', 80)->nullable($value = true);
            $table->unsignedBigInteger('idmarca');
            $table->foreign('idmarca', 'fk_softwares_marcas')->references('id')->on('marcas')->onDelete('restrict');
            $table->string('modelo', 20)->nullable($value = true);
            $table->string('tpsoft', 20)->nullable($value = true);
            $table->string('numserie', 25)->nullable($value = true);
            $table->string('licencia', 25)->nullable($value = true);
            $table->boolean('actualizar')->default(false);
            $table->string('origen', 50)->nullable($value = true);
            $table->string('hd', 50)->nullable($value = true);
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
        Schema::dropIfExists('softwares');
    }
}
