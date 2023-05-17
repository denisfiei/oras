<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->default('ORAS-APP');
            $table->string('descripcion')->nullable();
            $table->string('direccion')->default('123 Street, Miraflores, Lima');
            $table->string('codigo_tel', 5)->default('+51');
            $table->string('telefono_1', 15)->default('123456789');
            $table->string('telefono_2', 15)->nullable();
            $table->string('whatsapp', 15)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo_login')->nullable();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->timestamps();
        });

        DB::table('configs')->insert([
            [
                'nombre'=>'ORAS-APP',
                'descripcion'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.',
                'codigo_tel'=>'+51',
                'telefono_1'=>'123456789',
                'whatsapp'=>'+51953957595',
                'email'=>'oras-app@gmail.com',
                'user_id'=>1
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
        Schema::dropIfExists('configs');
    }
}
