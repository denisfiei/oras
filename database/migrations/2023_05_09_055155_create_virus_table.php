<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateVirusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('virus', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 20)->nullable();
            $table->string('nombre', 100);
            $table->char('activo', 1)->default('S')->comment("S=si, N=no");
            $table->timestamps();
        });

        DB::table('virus')->insert([
            [
                'codigo'=>'SASR-COV2',
                'nombre'=>'COVID-19'
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
        Schema::dropIfExists('virus');
    }
}
