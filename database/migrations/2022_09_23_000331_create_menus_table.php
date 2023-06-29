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
            ['categoria'=>'S', 'nombre'=>'Menus', 'icono'=>'fas fa-th-list', 'route'=>'menus', 'url'=>'menus', 'orden'=>1, 'user_id'=>1],
            ['categoria'=>'S', 'nombre'=>'Roles', 'icono'=>'fas fa-tasks', 'route'=>'roles', 'url'=>'roles', 'orden'=>2, 'user_id'=>1],
            ['categoria'=>'S', 'nombre'=>'Usuarios', 'icono'=>'fas fa-users', 'route'=>'users', 'url'=>'users', 'orden'=>3, 'user_id'=>1],
            ['categoria'=>'S', 'nombre'=>'Avisos', 'icono'=>'far fa-comment-alt', 'route'=>'avisos', 'url'=>'avisos', 'orden'=>4, 'user_id'=>1],
            ['categoria'=>'S', 'nombre'=>'Configuración', 'icono'=>'fas fa-cog', 'route'=>'config', 'url'=>'config', 'orden'=>5, 'user_id'=>1],
            ['categoria'=>'S', 'nombre'=>'Logs', 'icono'=>'fas fa-bullhorn', 'route'=>'logs', 'url'=>'logs', 'orden'=>6, 'user_id'=>1],

            ['categoria'=>'A', 'nombre'=>'Paises', 'icono'=>'fas fa-globe-americas', 'route'=>'paises', 'url'=>'paises', 'orden'=>1, 'user_id'=>1],
            ['categoria'=>'A', 'nombre'=>'Laboratorios', 'icono'=>'fas fa-flask', 'route'=>'laboratorios', 'url'=>'laboratorios', 'orden'=>2, 'user_id'=>1],
            ['categoria'=>'A', 'nombre'=>'Centros de Información', 'icono'=>'fas fa-university', 'route'=>'centros', 'url'=>'centros', 'orden'=>3, 'user_id'=>1],
            ['categoria'=>'A', 'nombre'=>'Tipos de Muestreo', 'icono'=>'fas fa-layer-group', 'route'=>'muestreos', 'url'=>'muestreos', 'orden'=>4, 'user_id'=>1],
            ['categoria'=>'A', 'nombre'=>'Recursos', 'icono'=>'far fa-file-alt', 'route'=>'recursos', 'url'=>'recursos', 'orden'=>5, 'user_id'=>1],
            
            ['categoria'=>'O', 'nombre'=>'Virus', 'icono'=>'fas fa-virus', 'route'=>'virus', 'url'=>'virus', 'orden'=>1, 'user_id'=>1],
            ['categoria'=>'O', 'nombre'=>'Linajes', 'icono'=>'fas fa-bezier-curve', 'route'=>'linajes', 'url'=>'linajes', 'orden'=>2, 'user_id'=>1],
            ['categoria'=>'O', 'nombre'=>'Carga de Datos', 'icono'=>'fas fa-file-upload', 'route'=>'cargas', 'url'=>'cargas', 'orden'=>3, 'user_id'=>1],
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
