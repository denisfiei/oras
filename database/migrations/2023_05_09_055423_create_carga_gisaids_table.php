<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargaGisaidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carga_gisaids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('carga_id')->references('id')->on('cargas')->onDelete('restrict');
            $table->foreignId('virus_id')->references('id')->on('virus')->onDelete('restrict');
            //$table->foreignId('linaje_id')->references('id')->on('linajes')->onDelete('restrict');
            $table->foreignId('pais_id')->references('id')->on('paises')->onDelete('restrict');
            $table->string('virus_name', 100);
            $table->string('accession_id', 100);
            $table->date('collection_date')->nullable();
            $table->string('location')->nullable();
            $table->string('host', 20)->nullable();
            $table->string('additional_location_information')->nullable();
            $table->string('sampling_strategy')->nullable();
            $table->string('gender', 20)->nullable();
            $table->string('patient_age', 20)->nullable();
            $table->string('patient_status')->nullable();
            $table->string('last_vaccinated')->nullable();
            $table->string('passage', 20)->nullable();
            $table->string('specimen')->nullable();
            $table->string('additional_host_information')->nullable();
            $table->string('lineage', 20)->nullable();
            $table->string('clade', 20)->nullable();
            $table->text('aa_substitutions')->nullable();
            $table->char('activo', 1)->default('S')->comment("S=si, N=no");
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carga_gisaids');
    }
}
