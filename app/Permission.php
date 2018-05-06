<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraerp\Ordination\OrdinationTrait;

class Permission extends Model
{
    use OrdinationTrait;
    
    protected $fillable = [
        'name', 'description'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function search($request, $totalPage = 5)
    {
        $keySearch = $request->key_search;
        return $this->where('name', 'LIKE', "%{$keySearch}%")
                    ->orwhere('description', 'LIKE', "%{$keySearch}%")
                    ->paginate($totalPage);
    }
}
