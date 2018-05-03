<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p1 = Permission::firstOrCreate([
            'name' => 'user-view',
            'description' => 'Acesso a listagem de usuários',
        ]);

        $p2 = Permission::firstOrCreate([
            'name' => 'user-create',
            'description' => 'Acesso a adicionar usuários.',
        ]);

        $p3 = Permission::firstOrCreate([
            'name' => 'user-edit',
            'description' => 'Acesso editar usuários.',
        ]);

        $p4 = Permission::firstOrCreate([
            'name' => 'user-delete',
            'description' => 'Acesso a excluir usuários',
        ]);



        $r1 = Permission::firstOrCreate([
            'name' => 'role-view',
            'description' => 'Acesso a listagem de tipos de usuários.',
        ]);

        $r2 = Permission::firstOrCreate([
            'name' => 'role-create',
            'description' => 'Acesso a adicionar tipos de usuários.',
        ]);

        $r3 = Permission::firstOrCreate([
            'name' => 'role-edit',
            'description' => 'Acesso editar tipos de usuários.',
        ]);

        $r4 = Permission::firstOrCreate([
            'name' => 'role-delete',
            'description' => 'Acesso a excluir de tipos de usuários',
        ]);



        $c1 = Permission::firstOrCreate([
            'name' => 'company-view',
            'description' => 'Acesso a listagem de companhias.',
        ]);

        $c2 = Permission::firstOrCreate([
            'name' => 'company-create',
            'description' => 'Acesso a adicionar companhias.',
        ]);

        $c3 = Permission::firstOrCreate([
            'name' => 'company-edit',
            'description' => 'Acesso editar companhias.',
        ]);

        $c4 = Permission::firstOrCreate([
            'name' => 'company-delete',
            'description' => 'Acesso a excluir companhias.',
        ]);
    }
}
