<?php

use Illuminate\Database\Seeder;
use App\Models\Person_type;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pt1 = Person_type::firstOrCreate([
            'description' => 'Pessoa física',
        ]);
        $pt2 = Person_type::firstOrCreate([
            'description' => 'Pessoa jurídica',
        ]);

        $u1 = User::firstOrCreate([
            'person_type_id' => 1,
            'name' => 'Administrador do sistema',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);  
    }
}
