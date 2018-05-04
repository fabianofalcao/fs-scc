<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function newPermission($permission)
    {
        if(is_string($permission))
            $permission = Permission::where('name', '=', $permission)->firstOrFail();
        
        if($this->permissionExists($permission))
            return false;
        
        return $this->permissions()->attach($permission);
    }

    public function delPermission($permission)
    {
        if(is_string($permission))
            $permission = Permission::where('name', '=', $permission)->firstOrFail();
        return $this->permissions()->detach($permission);   
    }

    public function permissionExists($permission)
    {
        if(is_string($permission))
            $permission = Permission::where('name', '=', $permission)->firstOrFail();
        return (boolean) $this->permissions()->find($permission->id);
    }
}
