<?php

namespace App\Http\Requests\Lecture;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LectureSaveRequest extends FormRequest
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
            $lecture = $this->route('lecture');
            return [
                'topic' => [Rule::unique('lectures')->ignore($lecture), 'string'],
                'description' => ['string']
            ];
        }

        return [
            'topic' => ['required', 'unique:lectures,topic','string'],
            'description' => ['string']
        ];
    }
}
