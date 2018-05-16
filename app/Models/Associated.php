<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laraerp\Ordination\OrdinationTrait;
use App\User;
use App\Role;
use App\Models\Person_physical;
use DB;

class Associated extends Model
{
    use OrdinationTrait;

    protected $fillable = ['user_id', 'marital_status_id', 'bank_id', 'bank_branch', 'bank_account', 'bank_type_account',
                            'role', 'admission_date', 'affiliation_date', 'automatic_debit_code', 'credit_limit', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function person_physical()
    {
        return $this->hasOne(Person_physical::class, 'user_id', 'user_id');
    }

    public function marital_status()
    {
        return $this->belongsTo(Marital_status::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function newAssociated($request, $user)
    {
        $dataForm = $request->all();
        $dataForm['credit_limit'] = str_replace(',','.',str_replace('.','',$dataForm['credit_limit']));
        
        // Verifico se o usuário já exsite
        $exists = Person_physical::where('cpf')->with('user')->get()->first();
        //Caso exista insiro somente na tabela de partner
        if($exists){
            $dataForm['user_id'] = $exists->user->id;
            $person_physical = Person_physical::create($dataForm); 
            
            //Cadastro na tabela role_user o papel de usuario
            if($idRoles){
                foreach($idRoles as $idRole){
                    $role = Role::find($idRole);
                    $exists->user->roles()->attach($role);
                }
            }
            return $exists->user;
        } else {
            //dd($dataForm);
            // Cadastro o usuário oas roles e person_legal
            $newUser = $user->newUser($request);
                        
            if(!$newUser)
                return false;

            // Cadastro na tablea de parceiros
            $dataForm['user_id'] = $newUser->id;
            $dataForm['date_birth'] = formatDateAndTime(str_replace('/', '-', $dataForm['date_birth']), "Y-m-d");
            $dataForm['admission_date'] = ($dataForm['admission_date'] != null ? formatDateAndTime(str_replace('/', '-', $dataForm['admission_date']), "Y-m-d") : null);
            $dataForm['affiliation_date'] = ($dataForm['affiliation_date'] != null ? formatDateAndTime(str_replace('/', '-', $dataForm['affiliation_date']), "Y-m-d") : null);
            $dataForm['credit_limit'] = ($dataForm['credit_limit'] == null ? 0.00 : null);
            
            $associated = $this->create($dataForm); 
            return $associated;
        }
    }


    public function updateAssociated($request, $id)
    {
        $dataForm = $request->all();
        $dataForm['credit_limit'] = str_replace(',','.',str_replace('.','',$dataForm['credit_limit']));
        
        //Inicio a transação
        DB::beginTransaction();

        //Atualizo os dados da tabela associateds
        $dataForm['date_birth'] = formatDateAndTime(str_replace('/', '-', $dataForm['date_birth']), "Y-m-d");
        $dataForm['admission_date'] = ($dataForm['admission_date'] != null ? formatDateAndTime(str_replace('/', '-', $dataForm['admission_date']), "Y-m-d") : null);
        $dataForm['affiliation_date'] = ($dataForm['affiliation_date'] != null ? formatDateAndTime(str_replace('/', '-', $dataForm['affiliation_date']), "Y-m-d") : null);
        $associated = $this->update($dataForm);

        // Atualizo o usuário, e a person
        $user = $this->user;
        $updUser = $user->updateUser($request, $id);

        if($associated && $updUser){
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
        return $this->join('users', 'users.id', '=', 'associateds.user_id')
                    ->join('person_physicals', 'person_physicals.user_id', '=', 'users.id')
                    ->select('associateds.*', 'users.name', 'users.email', 'person_physicals.cpf')
                    ->where('users.name', 'LIKE', "%{$keySearch}%")
                    ->orwhere('users.email', 'LIKE', "%{$keySearch}%")
                    ->paginate($totalPage);
    }
}
