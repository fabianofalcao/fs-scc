<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyStoreUpdateFormRequest extends FormRequest
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
            'cnpj'                  => "required|min:14|max:18",
            'email'                 => "required|min:3|max:100|unique:companies,email,{$id},id",
            'responsible_name'      => "required|min:5|max:100",
            'address_zipcode'       => 'required|min:8|max:9',
            'address_city'          => 'required|min:5|max:100',
            'address_state'         => 'required|min:2|max:100',
        ];
    }
}
