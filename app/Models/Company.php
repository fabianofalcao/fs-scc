<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laraerp\Ordination\OrdinationTrait;

class Company extends Model
{
    use OrdinationTrait;

    protected $fillable = [
        'name', 'cnpj', 'ie', 'im','responsible_name', 'email', 'phone', 'cell', 'address_zipcode', 'address_street',
        'address_number', 'address_complement', 'address_neighborhood', 'address_city', 'address_state', 'site', 'path_logo',
        'cfg_txt_sale', 'cfg_txt_service', 'cfg_records_per_page'
    ];

    public function newCompany($request)
    {
        $dataForm = $request->all();
        $dataForm['cnpj'] = preg_replace('/[^0-9]/', '', $dataForm['cnpj']);
        $dataForm['ie'] = preg_replace('/[^0-9]/', '', $dataForm['ie']);
        $dataForm['im'] = preg_replace('/[^0-9]/', '', $dataForm['im']);
        $dataForm['phone'] = preg_replace('/[^0-9]/', '', $dataForm['phone']);
        $dataForm['cell'] = preg_replace('/[^0-9]/', '', $dataForm['cell']);
        $dataForm['address_zipcode'] = preg_replace('/[^0-9]/', '', $dataForm['address_zipcode']);
        return $this->create($dataForm);
    }

    public function updateCompany($request)
    {
        $dataForm = $request->all();
        $dataForm['cnpj'] = preg_replace('/[^0-9]/', '', $dataForm['cnpj']);
        $dataForm['ie'] = preg_replace('/[^0-9]/', '', $dataForm['ie']);
        $dataForm['im'] = preg_replace('/[^0-9]/', '', $dataForm['im']);
        $dataForm['phone'] = preg_replace('/[^0-9]/', '', $dataForm['phone']);
        $dataForm['cell'] = preg_replace('/[^0-9]/', '', $dataForm['cell']);
        $dataForm['address_zipcode'] = preg_replace('/[^0-9]/', '', $dataForm['address_zipcode']);
        return $this->update($dataForm);
    }
    
    public function search($request, $totalPage = 5)
    {
        
        $keySearch = $request->key_search;
        return $this->where('name', 'LIKE', "%{$keySearch}%")
                    ->orwhere('email', 'LIKE', "%{$keySearch}%")
                    ->paginate($totalPage);
    }
}
