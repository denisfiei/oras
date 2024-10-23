<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinajesDengueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linajes_dengue', function (Blueprint $table) {
            $table->id();
            $table->foreignId('carga_linajes_dengue_id')->references('id')->on('carga_linajes_dengue')->onDelete('restrict');
            $table->string('serotipo', 20)->default("");
            $table->string('genotipo', 20)->default("");
            $table->string('major_lineages', 50)->nullable();
            $table->string('min_lineages', 50)->nullable();
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
        Schema::dropIfExists('linajes_dengue');
    }
}
