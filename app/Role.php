<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

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

    public function newPermission($permissions_id, $role_id)
    {
        //dd($permissions_id, $role_id);
        
        //Inicio a transação
        DB::beginTransaction();

        //Atualizo a tabela permission_role
        DB::delete('DELETE FROM permission_role where role_id = ?', [$role_id]);
        if($permissions_id){
            foreach($permissions_id as $idPermission){
                $permission = Permission::find($idPermission);
                $this->permissions()->attach($permission);
            }
         }
        // Verifico se tudo ocorreu bem e dou commit ou rollback
        DB::commit();
        return true;
    }
   
}
