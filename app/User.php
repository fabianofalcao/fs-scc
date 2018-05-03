<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laraerp\Ordination\OrdinationTrait;
use DB;
use App\Models\Person_physical;
use App\Models\Person_type;

class User extends Authenticatable
{
    use Notifiable;
    use OrdinationTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'person_type_id', 'phone', 'cell', 'address_zipcode', 'address_street',
        'address_number', 'address_complement', 'address_neighborhood', 'address_city', 'address_state', 'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function person_physical()
    {
        return $this->hasOne(Person_physical::class);
    }

    public function person_type()
    {
        return $this->belongsTo(Person_type::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    
    public function newUser($request)
    {
        $dataForm = $request->all();
        $idRoles = $request->roles;
        $dataForm['cpf'] = preg_replace('/[^0-9]/', '', $dataForm['cpf']);
        $dataForm['phone'] = preg_replace('/[^0-9]/', '', $dataForm['phone']);
        $dataForm['cell'] = preg_replace('/[^0-9]/', '', $dataForm['cell']);
        $dataForm['address_zipcode'] = preg_replace('/[^0-9]/', '', $dataForm['address_zipcode']);
        $dataForm['password'] = bcrypt($dataForm['password']);

        //Inicio a transação
        DB::beginTransaction();

        // Cadastro na tabela users
        $this->name = $dataForm['name'];
        $this->password = ($dataForm['password'] ? bcrypt($dataForm['password']) : bcrypt('opgsv5@t,'));
        $this->email = $dataForm['email'];
        $this->person_type_id = $dataForm['person_type_id'];
        $this->phone = $dataForm['phone'];
        $this->cell = $dataForm['cell'];
        $this->address_zipcode = $dataForm['address_zipcode'];
        $this->address_street = $dataForm['address_street'];
        $this->address_number = $dataForm['address_number'];
        $this->address_complement = $dataForm['address_complement'];
        $this->address_neighborhood = $dataForm['address_neighborhood'];
        $this->address_city = $dataForm['address_city'];
        $this->address_state = $dataForm['address_state'];
        if(isset($dataForm['is_admin']))
            $this->is_admin = 1;
        else
            $this->is_admin = 0;
        $newUser = $this->save();

        // Cadastro na tabela pessoa física
        $dataForm['user_id'] = $this->id;
        $dataForm['date_birth'] = formatDateAndTime(str_replace('/', '-', $dataForm['date_birth']), "Y-m-d");
        $person_physical = Person_physical::create($dataForm);

        //Cadastro na tabela role_user
        if($idRoles){
            foreach($idRoles as $idRole){
                $role = Role::find($idRole);
                $this->roles()->attach($role);
            }
        }

        // Verifico se tudo ocorreu bem e dou commit ou rollback
        if($newUser && $person_physical){
            DB::commit();
            return $newUser;
        } else {
            DB::rollback();
            return false;
        }
    }

    public function updateUser($request, $id)
    {
        $dataForm = $request->all();
        $idRoles = $request->roles;
        //dd($idRoles);
        $dataForm['cpf'] = preg_replace('/[^0-9]/', '', $dataForm['cpf']);
        $dataForm['phone'] = preg_replace('/[^0-9]/', '', $dataForm['phone']);
        $dataForm['cell'] = preg_replace('/[^0-9]/', '', $dataForm['cell']);
        $dataForm['address_zipcode'] = preg_replace('/[^0-9]/', '', $dataForm['address_zipcode']);
        $dataForm['password'] = bcrypt($dataForm['password']);

        //Inicio a transação
        DB::beginTransaction();

        //Atualizo a tabela role_user
        DB::delete('DELETE FROM role_user where user_id = ?', [$id]);
        if($idRoles){
            foreach($idRoles as $idRole){
                $role = Role::find($idRole);
                $this->roles()->attach($role);
            }
        }   

        // Atualizo os dados da tabela pessoa física
        $dataForm['user_id'] = $id;
        $dataForm['date_birth'] = formatDateAndTime(str_replace('/', '-', $dataForm['date_birth']), "Y-m-d");
        $updPersonPhysical = $this->person_physical->update($dataForm);
        
        // Atualizo a tabela users
        $this->name = $dataForm['name'];
        if($request->password && $request->password != '')
            $this->password = bcrypt($request->password);
        $this->email = $dataForm['email'];
        $this->person_type_id = $dataForm['person_type_id'];
        $this->phone = $dataForm['phone'];
        $this->cell = $dataForm['cell'];
        $this->address_zipcode = $dataForm['address_zipcode'];
        $this->address_street = $dataForm['address_street'];
        $this->address_number = $dataForm['address_number'];
        $this->address_complement = $dataForm['address_complement'];
        $this->address_neighborhood = $dataForm['address_neighborhood'];
        $this->address_city = $dataForm['address_city'];
        $this->address_state = $dataForm['address_state'];
        if(isset($dataForm['is_admin']))
            $this->is_admin = 1;
        else
            $this->is_admin = 0;
       
        $updUser = $this->save();

        // Verifico se tudo ocorreu bem e dou commit ou rollback
        if($updUser && $updPersonPhysical){
            DB::commit();
            return $updUser;
        } else {
            DB::roolback();
            return false;
        }
    }

    
    public function search($request, $totalPage = 5)
    {
        
        $keySearch = $request->key_search;
        return $this->where('name', 'LIKE', "%{$keySearch}%")
                    ->orwhere('email', 'LIKE', "%{$keySearch}%")
                    ->paginate($totalPage);
    }
}
