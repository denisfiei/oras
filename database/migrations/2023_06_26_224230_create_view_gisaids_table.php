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
            l.nombre AS linaje, 
            cg.carga_id AS carga_id, 
            cg.virus_id AS virus_id, 
            cg.virus_name AS virus_name,, 
            cg.accession_id AS accession_id, 
            cg.collection_date AS collection_date, 
            YEARWEEK( cg.collection_date, 0 ) AS semana, 
            UPPER(ltrim(REPLACE (substr(substring_index( cg.location, '/', 1 ),(length(substring_index( cg.location, '/', 0 )) + 1 )), '/', ''))) AS nivel0,
            UPPER(ltrim(REPLACE (substr(substring_index( cg.location, '/', 2 ),(length(substring_index( cg.location, '/', 1 )) + 1 )), '/', ''))) AS nivel1,
            UPPER(ltrim(REPLACE (substr(substring_index( cg.location, '/', 3 ),(length(substring_index( cg.location, '/', 2 )) + 1 )), '/', ''))) AS nivel2,
            UPPER(ltrim(REPLACE (substr(substring_index( cg.location, '/', 4 ),(length(substring_index( cg.location, '/', 3 )) + 1 )), '/', ''))) AS nivel3,
            UPPER(ltrim(REPLACE (substr(substring_index( cg.location, '/', 5 ),(length(substring_index( cg.location, '/', 4 )) + 1 )), '/', ''))) AS nivel4,
            cg.host AS host, 
            cg.gender AS gender, 
            cg.patient_age AS patient_age, 
            cg.patient_status AS patient_status, 
            cg.passage AS passage, 
            cg.lineage AS lineage, 
            cg.clade AS clade, 
            c.activo AS activo,
            mapas.latitud AS latitud,
            mapas.longitud AS longitud,
            mapas.geo_shape AS geo_shape,
            ( SELECT sei.inicio FROM semana_epidemiologica sei WHERE((sei.inicio <= cg.collection_date ) AND ( sei.fin >= cg.collection_date ))) AS inicio
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
            LEFT JOIN
            mapas
            ON 
                cg.ubigeo = mapas.id
        WHERE
            cg.host = 'Human' AND
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
