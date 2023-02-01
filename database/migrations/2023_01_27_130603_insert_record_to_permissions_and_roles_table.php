<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class InsertRecordToPermissionsAndRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Create all permissions
        $permissions = [
            ['name' => 'cargas', 'module' => 'Cargas'],
            ['name' => 'clientes', 'module' => 'Clientes'],
            ['name' => 'destinos', 'module' => 'Destinos'],
            ['name' => 'plantas', 'module' => 'Plantas'],
            ['name' => 'punto_cargas', 'module' => 'Punto de cargas'],
            ['name' => 'empresa_transportes', 'module' => 'Empresa de transportes'],
            ['name' => 'tipo_cargas', 'module' => 'Tipo de cargas'],
            ['name' => 'tamano_bolas', 'module' => 'Tamaño de bolas'],
            ['name' => 'usuarios', 'module' => 'Usuarios'],
            ['name' => 'patentes', 'module' => 'Patentes'],
            ['name' => 'choferes', 'module' => 'Choferes'],
            ['name' => 'paises', 'module' => 'Paises'],
        ];

        $methods = ['index', 'create', 'edit', 'delete'];

        $name_permissions = [];

        foreach ($permissions as $permission) {
            foreach ($methods as $method) {

                $name_permissions[] = $permission['name'] . '.' . $method;

                Permission::firstOrCreate([
                    'name' => $permission['name'] . '.' . $method,
                    'module' => $permission['module']
                ]);
            }
        }

        //Create rol logistica
        Role::firstOrCreate(['name' => 'Logistica']);

        //Create rol cliente
        Role::firstOrCreate(['name' => 'Cliente']);

        //Create rol admin
        Role::firstOrCreate(['name' => 'Admin']);

        //Asignacion de rol administrador
        User::find(1)->assignRole('Admin')->givePermissionTo($name_permissions);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $usuario = User::find(1);

        $permissions = $usuario->getPermissionNames();

        $usuario->removeRole('Admin')->revokePermissionTo($permissions);
    }
}
