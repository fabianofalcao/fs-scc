<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laraerp\Ordination\OrdinationTrait;
use DB;
use App\Models\Person_physical;
use App\Models\Person_legal;
use App\Models\Person_type;
use App\Models\Partner;

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

    public function person_legal()
    {
        return $this->hasOne(Person_legal::class);
    }

    public function person_type()
    {
        return $this->belongsTo(Person_type::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function partner()
    {
        return $this->hasOne(Partner::class);
    }

    
    public function newUser($request)
    {
        $dataForm = $request->all();
        $idRoles = $request->roles;
        if(isset($dataForm['cpf']))
            $dataForm['cpf'] = preg_replace('/[^0-9]/', '', $dataForm['cpf']);
        if(isset($dataForm['cnpj']))
            $dataForm['cnpj'] = preg_replace('/[^0-9]/', '', $dataForm['cnpj']);
        $dataForm['phone'] = preg_replace('/[^0-9]/', '', $dataForm['phone']);
        $dataForm['cell'] = preg_replace('/[^0-9]/', '', $dataForm['cell']);
        $dataForm['address_zipcode'] = preg_replace('/[^0-9]/', '', $dataForm['address_zipcode']);
        $dataForm['password'] = bcrypt($dataForm['password']);
        
        //Inicio a transação
        DB::beginTransaction();

        // Cadastro na tabela users
        $this->name = $dataForm['name'];
        $this->password = ($dataForm['password'] ? $dataForm['password'] : bcrypt('opgsv5@t,'));
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

        //Verifico se é pessoa física ou juridica
        if($this->person_type_id == 1){
            // Cadastro na tabela pessoa física
            $dataForm['user_id'] = $this->id;
            $dataForm['date_birth'] = formatDateAndTime(str_replace('/', '-', $dataForm['date_birth']), "Y-m-d");
            $person_physical = Person_physical::create($dataForm);
        } else if($this->person_type_id == 2){
            // Cadastro na tabela pessoa juridica
            $dataForm['user_id'] = $this->id;
            $person_legal = Person_legal::create($dataForm);
        }

        //Cadastro na tabela role_user
        if($idRoles){
            foreach($idRoles as $idRole){
                $role = Role::find($idRole);
                $this->roles()->attach($role);
            }
        }

        // Verifico se tudo ocorreu bem e dou commit ou rollback
        if($newUser && (isset($person_physical) || isset($person_legal))){
            DB::commit();
            return $this;
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
        if(isset($dataForm['cpf']))
            $dataForm['cpf'] = preg_replace('/[^0-9]/', '', $dataForm['cpf']);
        if(isset($dataForm['cnpj']))
            $dataForm['cnpj'] = preg_replace('/[^0-9]/', '', $dataForm['cnpj']);
        $dataForm['phone'] = preg_replace('/[^0-9]/', '', $dataForm['phone']);
        $dataForm['cell'] = preg_replace('/[^0-9]/', '', $dataForm['cell']);
        $dataForm['address_zipcode'] = preg_replace('/[^0-9]/', '', $dataForm['address_zipcode']);
        $dataForm['password'] = bcrypt($dataForm['password']);
        
        //Inicio a transação
        DB::beginTransaction();

         //Caso existam roles enviadas atualizo a tabela role_user
        if($idRoles){
            DB::delete('DELETE FROM role_user where user_id = ?', [$id]);
            foreach($idRoles as $idRole){
                $role = Role::find($idRole);
                $this->roles()->attach($role);
            }
        }   

        //Verifico se é pessoa física ou juridica
        if($this->person_type_id == 1){
            // Cadastro na tabela pessoa física
            $dataForm['date_birth'] = formatDateAndTime(str_replace('/', '-', $dataForm['date_birth']), "Y-m-d");
            $person_physical = $this->person_physical->update($dataForm);
        } else if($this->person_type_id == 2){
            // Cadastro na tabela pessoa juridica
            $person_legal = $this->person_legal->update($dataForm);
        }

        /*
        // Atualizo os dados da tabela pessoa física
        $dataForm['user_id'] = $id;
        $dataForm['date_birth'] = formatDateAndTime(str_replace('/', '-', $dataForm['date_birth']), "Y-m-d");
        $updPersonPhysical = $this->person_physical->update($dataForm);
        */
        
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
        if($updUser){
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

    public function hasRole($roles)
    {   
        //dd($roles);
        
        if($roles){            
            $userRoles = $this->roles;
            //dd($roles, $userRoles);
            //dd($roles->intersect($userRoles)->count());
            return $roles->intersect($userRoles)->count();
        } 
    }
}
