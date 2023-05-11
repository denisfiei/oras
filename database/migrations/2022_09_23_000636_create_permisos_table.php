<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;

class CreatePermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permisos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rol_id')->references('id')->on('roles')->onDelete('restrict');
            $table->foreignId('menu_id')->references('id')->on('menus')->onDelete('restrict');
            $table->char('crear', 1)->default('N')->comment("S=si, N=no");
            $table->char('editar', 1)->default('N')->comment("S=si, N=no");
            $table->char('eliminar', 1)->default('N')->comment("S=si, N=no");
            $table->char('otros', 1)->default('N')->comment("S=si, N=no");
            $table->char('activo', 1)->default('N')->comment("S=si, N=no");
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->timestamps();
        });
    
        $internos = Menu::where('activo', 'S')->orderBy('orden')->get();
        $data = [];
        foreach ($internos as $value) {
            $data[] = [
                'rol_id' => 1,
                'menu_id' => $value->id,
                'crear' => 'S',
                'editar' => 'S',
                'eliminar' => 'S',
                'otros' => 'S',
                'activo' => 'S',
                'user_id' => 1
            ];
        }
        
        DB::table('permisos')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permisos');
    }
}
