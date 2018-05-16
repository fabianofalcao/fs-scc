<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckCPF;
use App\Models\Associated;

class AssociatedStoreUpdateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->segment(3);
        $associated = Associated::find($id);
        return [
            'name'                  => "required|min:3|max:100",
            'password'              => 'max:15|confirmed',
            'email'                 => "required|min:3|max:100|unique:users,email,{$associated->user_id},id",
            'cpf'                   => [
                "required",
                "min:11",
                "max:14",
                "unique:person_physicals,cpf,{$associated->user_id},id",
                new checkCPF,
            ],
            'sexo'                  => 'required',
            'date_birth'            => 'required|date_format:d/m/Y',
            'marital_status_id'     => 'required',
            'bank_id'               => 'required|exists:banks,id',
            'address_zipcode'       => 'required|min:8|max:9',
            'address_city'          => 'required|min:5|max:100',
            'address_state'         => 'required|min:2|max:100',
            'status'    => 'required',
        ];
    }
}
