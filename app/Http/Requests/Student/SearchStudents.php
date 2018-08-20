<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class SearchStudents extends FormRequest
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
        return [
            'surname' => 'required|max:30',
            'name' => 'nullable|required_without:tel|email',
            'patronymic' => 'nullable|required_without:email|regex:/(01)[0-9]{9}/'
        ];
    }
}
