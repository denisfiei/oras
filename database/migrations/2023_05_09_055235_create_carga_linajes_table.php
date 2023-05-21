<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargaLinajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carga_linajes', function (Blueprint $table) {
            $table->id();
            $table->string('archivo', 100)->nullable();
            $table->string('file', 50)->nullable();
            $table->double('cantidad', 15, 0);
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
        Schema::dropIfExists('carga_linajes');
    }
}
