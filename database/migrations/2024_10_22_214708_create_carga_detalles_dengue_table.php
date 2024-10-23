<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargaDetallesDengueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carga_detalles_dengue', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cargas_dengue_id')->references('id')->on('cargas_dengue')->onDelete('restrict');
            $table->foreignId('virus_id')->references('id')->on('virus')->onDelete('restrict');
            //$table->foreignId('linaje_id')->references('id')->on('linajes')->onDelete('restrict');
            $table->foreignId('pais_id')->references('id')->on('paises')->onDelete('restrict');
            $table->string('virus_name', 100)->nullable();
            $table->string('kit_ct', 100)->nullable();
            $table->string('gen', 100)->nullable();
            $table->string('ct', 50)->nullable();
            $table->string('ct2', 50)->nullable();
            $table->foreignId('tipo_muestreo_id')->nullable()->references('id')->on('tipo_muestreos')->onDelete('restrict');
            $table->string('numeracion_placa', 100)->nullable();
            $table->string('placa', 100)->nullable();
            $table->string('corrida', 50)->nullable();
            $table->string('verificado', 50)->nullable();
            $table->date('fecha_sistema')->nullable();
            $table->string('coverage', 50)->nullable();
            $table->string('n_percentage', 20)->nullable();
            $table->char('asintomatico', 2)->default('NO');
            $table->text('sintomas')->nullable();
            $table->char('comorbilidad', 2)->default('NO');
            $table->text('lista_comorbilidad')->nullable();
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
        Schema::dropIfExists('carga_detalles_dengue');
    }
}
