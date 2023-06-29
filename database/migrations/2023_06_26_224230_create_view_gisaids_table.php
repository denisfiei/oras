<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateViewGisaidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW view_gisaid AS 
        SELECT
            l.nombre, 
            cg.carga_id, 
            cg.virus_id, 
            cg.virus_name, 
            cg.accession_id, 
            cg.collection_date, 
            SUBSTRING_INDEX(SUBSTRING_INDEX(cg.location, ' / ', 1), ' / ', -1) AS mapa, 
            SUBSTRING_INDEX(SUBSTRING_INDEX(cg.location, ' / ', 2), ' / ', -1) AS pais, 
            SUBSTRING_INDEX(SUBSTRING_INDEX(cg.location, ' / ', 3), ' / ', -1) AS region, 
            cg.`host`, 
            cg.gender, 
            cg.patient_age, 
            cg.patient_status, 
            cg.passage, 
            cg.lineage, 
            cg.clade, 
            c.activo
        FROM
            carga_gisaids AS cg
            LEFT JOIN
            linajes AS l
            ON 
                cg.lineage = l.codigo
            INNER JOIN
            cargas AS c
            ON 
                cg.carga_id = c.id
        WHERE
            cg.`host` = 'Human' AND
            cg.passage = 'Original'
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW view_gisaid");
    }
}
