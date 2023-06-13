<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateRangoEdadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rango_edades', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->double('desde', 3, 0);
            $table->double('hasta', 3, 0);
        });

        DB::table('rango_edades')->insert([
            ['nombre'=>'00 a 05 años', 'desde'=>'0', 'hasta'=>'5'],
            ['nombre'=>'06 a 10 años', 'desde'=>'6', 'hasta'=>'10'],
            ['nombre'=>'11 a 15 años', 'desde'=>'11', 'hasta'=>'15'],
            ['nombre'=>'16 a 20 años', 'desde'=>'16', 'hasta'=>'20'],
            ['nombre'=>'21 a 30 años', 'desde'=>'21', 'hasta'=>'30'],
            ['nombre'=>'31 a 40 años', 'desde'=>'31', 'hasta'=>'40'],
            ['nombre'=>'41 a 50 años', 'desde'=>'41', 'hasta'=>'50'],
            ['nombre'=>'51 a 60 años', 'desde'=>'51', 'hasta'=>'60'],
            ['nombre'=>'61 a 70 años', 'desde'=>'61', 'hasta'=>'70'],
            ['nombre'=>'71 a 80 años', 'desde'=>'71', 'hasta'=>'80'],
            ['nombre'=>'81 a 90 años', 'desde'=>'81', 'hasta'=>'90'],
            ['nombre'=>'Mayores a 90 años', 'desde'=>'91', 'hasta'=>'200'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rango_edades');
    }
}
