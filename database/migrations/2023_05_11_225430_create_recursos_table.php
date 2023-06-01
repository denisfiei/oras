<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recursos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pais_id')->nullable()->references('id')->on('paises')->onDelete('restrict');
            $table->foreignId('centro_id')->nullable()->references('id')->on('centros')->onDelete('restrict');
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->date('fecha')->nullable();
            $table->string('ruta')->nullable();
            $table->string('imagen', 50)->nullable();
            $table->string('enlace')->nullable(); 
            $table->tinyInteger('orden')->default(0);
            $table->tinyInteger('nivel')->default(0);
            $table->char('activo', 1)->default('S')->comment("S=si, N=no");
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
        Schema::dropIfExists('recursos');
    }
}
