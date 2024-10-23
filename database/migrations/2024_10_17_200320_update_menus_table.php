<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('menus')->insert([

            ['categoria'=>'O', 'nombre'=>'Tipo Dengue', 'icono'=>'fas fal fa-vial', 'route'=>'tipo_dengue', 'url'=>'tipo_dengue', 'orden'=>7, 'user_id'=>1],
            ['categoria'=>'O', 'nombre'=>'Carga de Datos', 'icono'=>'fas fa-file-upload', 'route'=>'carga_dengue', 'url'=>'carga_dengue', 'orden'=>8, 'user_id'=>1]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
