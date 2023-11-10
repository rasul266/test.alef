<?php

namespace App\Http\Requests\Students;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentSaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->method() == 'PUT' or $this->method() == 'PATCH') {
            $student = $this->route('student');
            return [
                'name' => ['string'],
                'email' => ['email', Rule::unique('students')->ignore($student)],
                'classroom_id' => ['integer', 'exists:classrooms,id']
            ];
        }

        return [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:students,email'],
            'classroom_id' => ['required', 'exists:classrooms,id']
        ];
    }
}
