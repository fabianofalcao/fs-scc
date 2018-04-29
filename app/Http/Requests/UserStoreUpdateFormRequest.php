<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckCPF;

class UserStoreUpdateFormRequest extends FormRequest
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
        return [
            'name'                  => "required|min:3|max:100",
            'password'              => 'max:15|confirmed',
            'email'                 => "required|min:3|max:100|unique:users,email,{$id},id",
            'cpf'                   => [
                "required",
                "min:11",
                "max:14",
                "unique:person_physicals,cpf,{$id},user_id",
                new checkCPF,
            ],
            'person_type_id'        => "required|exists:person_types,id",
            'sexo'                  => 'required',
            'date_birth'            => 'required|date_format:d/m/Y',
            'address_zipcode'       => 'required|min:8|max:9',
            'address_city'          => 'required|min:5|max:100',
            'address_state'         => 'required|min:2|max:100',
        ];
    }
}
