<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddIconToCentros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('centros', function (Blueprint $table) {
            $table->string('icono', 50)->default('fas fa-user');
        });

        DB::table('centros')->insert([
            ['nombre'=>'DOCUMENTOS TÉCNICOS', 'icono'=>'fal fa-file-invoice'],
            ['nombre'=>'PUBLICACIONES', 'icono'=>'fas fa-books'],
            ['nombre'=>'PIPELINE O WORKFLOW', 'icono'=>'fal fa-folder-open'],
            ['nombre'=>'SALA DE PRENSA', 'icono'=>'far fa-exclamation-circle']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('centros', function (Blueprint $table) {
            $table->dropColumn('icon');
        });
    }
}
