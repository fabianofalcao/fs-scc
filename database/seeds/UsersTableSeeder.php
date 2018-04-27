<?php

use Illuminate\Database\Seeder;
use App\Models\Person_type;
use App\User;
use Faker\Provider\fr_BE\Person;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Person_type::create([
            'description' => 'Pessoa física',
        ]);
        Person_type::create([
            'description' => 'Pessoa jurídica',
        ]);

        User::create([
            'person_type_id' => 1,
            'name' => 'Administrador do sistema',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);  
    }
}
