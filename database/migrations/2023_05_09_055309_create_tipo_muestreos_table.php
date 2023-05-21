<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTipoMuestreosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_muestreos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 10)->nullable();
            $table->string('nombre', 50);
            $table->char('activo', 1)->default('S')->comment("S=si, N=no");
            $table->timestamps();
        });

        DB::table('tipo_muestreos')->insert([
            [
                'codigo'=>'0001',
                'nombre'=>'VIGILANCIA'
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
        Schema::dropIfExists('tipo_muestreos');
    }
}
