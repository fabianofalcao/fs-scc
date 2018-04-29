<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laraerp\Ordination\OrdinationTrait;
use DB;
use App\Models\Person_physical;

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

    
    public function newUser($request)
    {
        $dataForm = $request->all();
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
        $this->is_admin = ($dataForm['is_admin'] ? 1 : 0);
        $newUser = $this->save();

        // Cadastro na tabela pessoa física
        $dataForm['user_id'] = $this->id;
        $dataForm['date_birth'] = formatDateAndTime(str_replace('/', '-', $dataForm['date_birth']), "Y-m-d");
        $person_physical = Person_physical::create($dataForm);

        // Verifico se tudo ocorreu bem e dou commit ou rollback
        if($newUser && $person_physical){
            DB::commit();
            return $newUser;
        } else {
            DB::roolback();
            return false;
        }
    }

    
    public function search($request, $totalPage = 5)
    {
        
        $keySearch = $request->key_search;
        return $this->where('name', 'LIKE', "%{$keySearch}%")
                    ->paginate($totalPage);
    }
}
