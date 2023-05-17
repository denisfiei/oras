<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePaisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paises', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 10)->nullable();
            $table->string('codigo_tel', 5)->default('51');
            $table->string('nombre', 50);
            $table->string('bandera', 100)->nullable();
            $table->char('activo', 1)->default('S')->comment("S=si, N=no");
            $table->timestamps();
        });

        DB::table('paises')->insert([
            ['codigo_tel'=>'+51', 'nombre' => 'Perú', 'bandera' => 'peru.webp'],
            ['codigo_tel'=>'+57', 'nombre' => 'Colombia', 'bandera' => 'colombia.webp'],
            ['codigo_tel'=>'+591', 'nombre' => 'Bolivia', 'bandera' => 'bolivia.webp'],
            ['codigo_tel'=>'+593', 'nombre' => 'Ecuador', 'bandera' => 'ecuador.webp']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paises');
    }
}
