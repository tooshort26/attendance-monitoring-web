<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Course;
use App\Subject;

class AddStudentRequest extends FormRequest
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
      return [
              'name'                   => 'required',
              'gender'                 => ['required', Rule::in(['male', 'gender'])],
              'course_id'              => ['required', Rule::in($courses)],
              'id_number'              => 'required|unique:students',
              'password'               => 'required|confirmed',
              'level'                 => 'required|numeric',
              'birthdate'              => 'required|date'
        ];

    }

    public function attributes()
    {
        return [
            'course_id'              => 'course',
            'id_number'              => 'ID number',
            'level'             => 'year level'
        ];
    }

}
