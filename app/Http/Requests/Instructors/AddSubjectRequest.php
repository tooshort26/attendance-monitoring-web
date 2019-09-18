<?php

namespace App\Http\Requests\Instructors;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddSubjectRequest extends FormRequest
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
        $semester = [1, 2, 3];
        return [
            'name'               => 'required',
            'description'        => 'required',
            'level'              => 'required|numeric',
            'semester'           => [Rule::in($semester)],
            'block'              => 'required',
            'students.ids.*'     => 'required',
            'students.names.*'   => 'required',
            'students.remarks.*' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'students.names.*'   => 'names',
            'students.remarks.*' => 'grade',
            'name'               => 'subject name',
            'description'        => 'subject description',
            'level'              => 'subject level',
            
        ];
    }
}
