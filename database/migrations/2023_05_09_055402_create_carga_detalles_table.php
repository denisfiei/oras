<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargaDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carga_detalles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('carga_id')->references('id')->on('cargas')->onDelete('restrict');
            $table->foreignId('virus_id')->references('id')->on('virus')->onDelete('restrict');
            $table->foreignId('tipo_muestreo_id')->references('id')->on('tipo_muestreos')->onDelete('restrict');
            //$table->foreignId('linaje_id')->references('id')->on('linajes')->onDelete('restrict');
            $table->foreignId('pais_id')->references('id')->on('paises')->onDelete('restrict');
            $table->string('codigo', 50);
            $table->string('codigo_pais', 10);
            $table->string('kit_ct', 50)->nullable();
            $table->string('gen', 50)->nullable();
            $table->string('ct', 5)->nullable();
            $table->string('ct2', 5)->nullable();
            $table->date('fecha_muestra');
            $table->string('edad', 3)->nullable();
            $table->string('sexo', 20)->nullable();
            $table->char('vacunado', 2)->default('NO')->comment("SI, NO");
            $table->char('dosis_1', 2)->default('NO');
            $table->char('dosis_2', 2)->default('NO');
            $table->char('dosis_3', 2)->default('NO');
            $table->char('dosis_4', 2)->default('NO');
            $table->char('dosis_5', 2)->default('NO');
            $table->string('hospitalizacion', 5)->nullable();
            $table->char('fallecido', 2)->default('NO');
            $table->string('numero_placa', 20)->nullable();
            $table->string('placa')->nullable();
            $table->string('corrida', 5)->nullable();
            $table->date('fecha_sistema');
            $table->string('cobertura', 20)->nullable();
            $table->string('cobertura_porcentaje', 20)->nullable();
            $table->char('asintomatico', 2)->default('NO');
            $table->text('sintomas')->nullable();
            $table->char('comorbilidad', 2)->default('NO');
            $table->text('comorbilidad_lista')->nullable();
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
        Schema::dropIfExists('carga_detalles');
    }
}
