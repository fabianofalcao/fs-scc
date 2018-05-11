<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Partner;

class PartnerStoreUpdateFormRequest extends FormRequest
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
        $partner = Partner::find($id);
        
        return [
            'name'                  => "required|min:3|max:100",
            'cnpj'                  => "required|min:14|max:18|unique:person_legals,cnpj,{$partner->user_id},id",
            'email'                 => "required|min:3|max:100|unique:users,email,{$partner->user_id},id",
            'password'              => 'max:15|confirmed',
            'status'                => 'required',
            'responsible_name'      => "required|min:5|max:100",
            'address_zipcode'       => 'required|min:8|max:9',
            'address_city'          => 'required|min:5|max:100',
            'address_state'         => 'required|min:2|max:100',
        ];
    }
}
