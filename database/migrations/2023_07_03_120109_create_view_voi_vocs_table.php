<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateViewVoiVocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW view_voi_voc AS 
            SELECT
                voi_voc.codigo, 
                voi_voc.tipo,
                view_gisaid.nivel1,
                view_gisaid.activo
            FROM
                voi_voc
                LEFT JOIN
                view_gisaid
                ON 
                    voi_voc.codigo = view_gisaid.lineage
            WHERE
                voi_voc.activo = 'S'
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW view_voi_voc");
    }
}
