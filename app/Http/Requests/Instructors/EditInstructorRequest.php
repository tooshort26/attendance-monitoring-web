<?php

namespace App\Http\Requests\Instructors;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditInstructorRequest extends FormRequest
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
      $gender = ['male', 'female'];
      $rules = [
            'name'      => 'required',
            'gender'    => ['required', Rule::in($gender)],
            'birthdate' => 'required|date',
            'profile'   => 'nullable',
        ];

      if ( !is_null(request('password')) || !is_null(request()->password_confirmation) ) {
        $rules['password'] = 'required|confirmed|min:8|max:20';  
      }

        return $rules;
    }


    public function attributes()
    {
        return [
            'id_number' => 'employee number',
        ];
    }


}
