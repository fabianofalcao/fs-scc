<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Partner;

class Person_legal extends Model
{
    public $timestamps = false;
    protected $fillable = ['user_id', 'cnpj', 'ie', 'im', 'rsponsible_name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
}
