<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
            $table->string('token', 50);
            $table->char('activo', 1)->default('S')->comment("S=si, N=no");
            $table->timestamps();
        });

        DB::table('paises')->insert([
            ['codigo_tel'=>'+51', 'nombre' => 'Perú', 'bandera' => 'peru.webp', 'token' => Str::uuid()],
            ['codigo_tel'=>'+57', 'nombre' => 'Colombia', 'bandera' => 'colombia.webp', 'token' => Str::uuid()],
            ['codigo_tel'=>'+591', 'nombre' => 'Bolivia', 'bandera' => 'bolivia.webp', 'token' => Str::uuid()],
            ['codigo_tel'=>'+593', 'nombre' => 'Ecuador', 'bandera' => 'ecuador.webp', 'token' => Str::uuid()]
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
