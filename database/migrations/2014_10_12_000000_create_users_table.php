<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rol_id')->references('id')->on('roles')->onDelete('restrict');
            $table->foreignId('pais_id')->references('id')->on('paises')->onDelete('restrict');
            $table->foreignId('laboratorio_id')->references('id')->on('laboratorios')->onDelete('restrict');
            $table->string('nombres');
            $table->string('codigo_tel', 5)->default('51');
            $table->string('telefono', 9)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('token');
            $table->char('activo', 1)->default('S')->comment('S=si, N=no, I=inactivo');
            $table->timestamps();
        });

        DB::table('users')->insert([
            [
                'rol_id'=>1,
                'pais_id'=>'1',
                'laboratorio_id'=>1,
                'nombres'=>'ADMINISTRADOR DEL SISTEMA',
                'codigo_tel'=>'+51',
                'telefono'=>'953957595',
                'email'=>'admin@gmail.com',
                'password'=>Hash::make('123456'),
                'token'=>'jTqUvPVYqxdFoXMnatrHhiNLwSGi3HDB4J73fgnsFwohaHmn0C'
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
        Schema::dropIfExists('users');
    }
}
