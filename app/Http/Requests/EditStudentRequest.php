<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Course;

class EditStudentRequest extends FormRequest
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
        $courses = Course::pluck('id')->toArray();
        $gender = ['male', 'female'];

        $rules = [
            'name'      => 'required',
            'gender'    => ['required', Rule::in($gender)],
            'course_id' => ['required', Rule::in($courses)],
            'birthdate' => 'required|date',
            'profile'   => 'nullable',
        ];

        if (!is_null(request()->password) || !is_null(request()->password_confirmation)) {
            $rules['password'] = 'required|confirmed|min:8|max:20';
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'id_number' => 'ID Number',
            'course_id' => 'course',
            'level' =>  'year level',
        ];
    }
}
