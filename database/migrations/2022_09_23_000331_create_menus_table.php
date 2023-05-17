<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->char('categoria', 1)->comment('S=menu de sistema, A=menu administrativo, O=menu operativo');
            $table->string('nombre', 50);
            $table->string('icono', 50);
            $table->string('route', 100);
            $table->string('url', 100);
            $table->tinyInteger('orden');
            $table->char('activo', 1)->default('S')->comment("S=si, N=no");
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->timestamps();
        });

        DB::table('menus')->insert([
            ['categoria'=>'S', 'nombre'=>'Menus', 'icono'=>'fas fa-user', 'route'=>'menus', 'url'=>'menus', 'orden'=>1, 'user_id'=>1],
            ['categoria'=>'S', 'nombre'=>'Usuarios', 'icono'=>'fas fa-user', 'route'=>'users', 'url'=>'users', 'orden'=>2, 'user_id'=>1],
            ['categoria'=>'S', 'nombre'=>'Roles', 'icono'=>'fas fa-users', 'route'=>'roles', 'url'=>'roles', 'orden'=>3, 'user_id'=>1],
            ['categoria'=>'S', 'nombre'=>'Avisos', 'icono'=>'fas fa-bullhorn', 'route'=>'avisos', 'url'=>'avisos', 'orden'=>4, 'user_id'=>1],
            ['categoria'=>'S', 'nombre'=>'Configuración', 'icono'=>'fas fa-cogs', 'route'=>'configuracion', 'url'=>'configuracion', 'orden'=>5, 'user_id'=>1],
            ['categoria'=>'S', 'nombre'=>'Logs', 'icono'=>'fas fa-bullhorn', 'route'=>'logs', 'url'=>'logs', 'orden'=>6, 'user_id'=>1],

            ['categoria'=>'A', 'nombre'=>'Paises', 'icono'=>'fas fa-home', 'route'=>'home', 'url'=>'home', 'orden'=>1, 'user_id'=>1],
            ['categoria'=>'A', 'nombre'=>'Laboratorios', 'icono'=>'fas fa-user', 'route'=>'users', 'url'=>'users', 'orden'=>2, 'user_id'=>1],
            ['categoria'=>'A', 'nombre'=>'Centros de Información', 'icono'=>'fas fa-users', 'route'=>'centros', 'url'=>'centros', 'orden'=>3, 'user_id'=>1],
            ['categoria'=>'A', 'nombre'=>'Recursos', 'icono'=>'fas fa-bars', 'route'=>'recursos', 'url'=>'recursos', 'orden'=>4, 'user_id'=>1],
            ['categoria'=>'A', 'nombre'=>'Tipos de Muestreo', 'icono'=>'fas fa-bars', 'route'=>'muestreos', 'url'=>'muestreos', 'orden'=>5, 'user_id'=>1],
            ['categoria'=>'A', 'nombre'=>'Linajes', 'icono'=>'fas fa-bars', 'route'=>'linajes', 'url'=>'linajes', 'orden'=>6, 'user_id'=>1],
            ['categoria'=>'A', 'nombre'=>'Virus', 'icono'=>'fas fa-bars', 'route'=>'virus', 'url'=>'virus', 'orden'=>7, 'user_id'=>1],

            ['categoria'=>'O', 'nombre'=>'Carga de Datos', 'icono'=>'fas fa-bars', 'route'=>'cargas', 'url'=>'cargas', 'orden'=>1, 'user_id'=>1],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
