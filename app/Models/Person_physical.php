<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person_physical extends Model
{
    public $timestamps = false;

    protected $fillable = ['user_id', 'cpf', 'rg', 'sexo', 'date_birth'];
}
