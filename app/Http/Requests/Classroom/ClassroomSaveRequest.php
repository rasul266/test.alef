<?php

namespace App\Http\Requests\Classroom;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClassroomSaveRequest extends FormRequest
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
            $classroom = $this->route('classroom');
            return [
                'name' => ['required', Rule::unique('classrooms')->ignore($classroom), 'string', 'max:255'],
            ];
        }

        return [
            'name' => ['required', 'unique:classrooms,name', 'string', 'max:255'],
        ];
    }
}
