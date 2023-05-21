<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('virus_id')->references('id')->on('virus')->onDelete('restrict');
            $table->foreignId('pais_id')->references('id')->on('paises')->onDelete('restrict');
            $table->string('archivo_gisaid', 100)->nullable();
            $table->string('file_gisaid', 50)->nullable();
            $table->string('log_gisaid', 50)->nullable();
            $table->double('cantidad_gisaid', 15, 0)->default(0);
            $table->string('archivo_detalle', 100)->nullable();
            $table->string('file_detalle', 50)->nullable();
            $table->string('log_detalle', 50)->nullable();
            $table->double('cantidad_detalle', 15, 0)->default(0);
            $table->char('activo', 1)->default('S')->comment("S=si, N=no");
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('restrict');
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
        Schema::dropIfExists('cargas');
    }
}
