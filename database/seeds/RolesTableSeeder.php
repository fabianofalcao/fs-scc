<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p1 = Role::firstOrCreate([
            'name' => 'Administrador',
            'description' => 'Acesso total ao sistema.',
        ]);

        $p2 = Role::firstOrCreate([
            'name' => 'Gerente',
            'description' => 'Gerenciamento dos dados da empresa.',
        ]);

        $p3 = Role::firstOrCreate([
            'name' => 'Associado',
            'description' => 'Acesso ao site como associado.',
        ]);

        $p4 = Role::firstOrCreate([
            'name' => 'Parceiro',
            'description' => 'Acesso ao site como parceiro.',
        ]);
    }
}
