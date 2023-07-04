<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoiVocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voi_voc', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 20);
            $table->char('tipo', 3)->comment("VOC, VOI");
            $table->char('activo', 1)->default('S')->comment("S=si, N=no");
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
        Schema::dropIfExists('voi_voc');
    }
}
