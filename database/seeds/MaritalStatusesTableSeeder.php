<?php

use Illuminate\Database\Seeder;
use App\Models\Marital_status;

class MaritalStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ec1 = Marital_status::firstOrCreate([
            'description' => 'Solteiro(a)',
        ]);
        
        $ec2 = Marital_status::firstOrCreate([
            'description' => 'Casado(a)',
        ]);

        $ec3 = Marital_status::firstOrCreate([
            'description' => 'Separado(a)',
        ]);
        
        $ec4 = Marital_status::firstOrCreate([
            'description' => 'Divorciado(a)',
        ]);

        $ec5 = Marital_status::firstOrCreate([
            'description' => 'Viúvo(a)',
        ]);
    }
}
