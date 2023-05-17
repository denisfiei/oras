<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateLaboratoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laboratorios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pais_id')->references('id')->on('paises')->onDelete('restrict');
            $table->string('codigo', 10)->nullable();
            $table->string('nombre');
            $table->string('direccion')->nullable();
            $table->string('email', 50)->nullable();
            $table->string('codigo_tel', 5)->default('51');
            $table->string('telefono', 15)->nullable();
            $table->char('activo', 1)->default('S')->comment("S=si, N=no");
            $table->timestamps();
        });

        DB::table('laboratorios')->insert([
            [
                'pais_id' => 1,
                'codigo' => '123456',
                'nombre' => 'LABORATORIO DE PRUEBAS',
                'direccion' => 'Lima 123',
                'codigo_tel' => '+51',
                'telefono' => '953957595',
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laboratorios');
    }
}
