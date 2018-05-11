<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laraerp\Ordination\OrdinationTrait;
use App\User;
use App\Role;
use App\Models\Person_legal;
use DB;

class Partner extends Model
{
    use OrdinationTrait;

    protected $fillable = ['user_id', 'date_start', 'status', 'comments'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function person_legal()
    {
        return $this->hasOne(Person_legal::class, 'user_id', 'user_id');
    }

    public function newPartner($request, $user)
    {
        $dataForm = $request->all();

        // Verifico se o usuário já exsite
        $exists = Person_legal::where('cnpj')->with('user')->get()->first();
        //Caso exista insiro somente na tabela de partner
        if($exists){
            
            $dataForm['user_id'] = $exists->user->id;
            $person_legal = Person_legal::create($dataForm); 
            
            //Cadastro na tabela role_user o papel de parceiro
            if($idRoles){
                foreach($idRoles as $idRole){
                    $role = Role::find($idRole);
                    $exists->user->roles()->attach($role);
                }
            }
            return $exists->user;

        } else {

            //dd('esse aqui');

            // Cadastro o usuário oas roles e person_legal
            $newUser = $user->newUser($request);
                        
            if(!$newUser)
                return false;

            // Cadastro na tablea de parceiros
            $dataForm['user_id'] = $newUser->id;
            $dataForm['date_start'] = formatDateAndTime(str_replace('/', '-', $dataForm['date_start']), "Y-m-d");
            $partner = $this->create($dataForm); 

            return $partner;

        }
    }


    public function updPartner($request, $id){
        
        $dataForm = $request->all();
        
        //
        //Inicio a transação
        DB::beginTransaction();

        //Atualizo os dados da tabela partners
        $dataForm['date_start'] = formatDateAndTime(str_replace('/', '-', $dataForm['date_start']), "Y-m-d");
        $partner = $this->update($dataForm);

        // Atualizo o usuário, e a person
        $user = $this->user;
        $updUser = $user->updateUser($request, $id);

        if($partner && $updUser){
            DB::commit();
            return true;
        } else {
            DB::rollback();
            return false;
        }
    }
    
    
    public function search($request, $totalPage = 5)
    {
        
        $keySearch = $request->key_search;
        return $this->join('users', 'users.id', '=', 'partners.user_id')
                    ->join('person_legals', 'person_legals.user_id', '=', 'users.id')
                    ->select('partners.*', 'users.name', 'users.email', 'person_legals.cnpj')
                    ->where('users.name', 'LIKE', "%{$keySearch}%")
                    ->orwhere('users.email', 'LIKE', "%{$keySearch}%")
                    ->paginate($totalPage);
    }
}
