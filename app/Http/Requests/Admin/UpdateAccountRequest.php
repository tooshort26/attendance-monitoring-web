<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Auth;


class UpdateAccountRequest extends FormRequest
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
        $rules = [
            'id_number' => 'required|unique:admins,id_number,'.Auth::user()->id,
            'name'      => 'required',
            'profile'   => 'nullable',
        ];
        
        if (!is_null(request()->password)) {
            $rules['password'] = 'required|confirmed';
        }

        return $rules;
    }
}
