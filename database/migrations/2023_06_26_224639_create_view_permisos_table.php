<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateViewPermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW view_permisos AS 
            SELECT
                permisos.id,
                permisos.rol_id,
                permisos.menu_id,
                permisos.activo
            FROM
                permisos
                INNER JOIN
                menus
                ON 
                    permisos.menu_id = menus.id
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW view_permisos");
    }
}
