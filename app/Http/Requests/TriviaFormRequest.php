<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TriviaFormRequest extends FormRequest
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
        return [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'number_of_questions' => 'required|integer|min:1|max:49',
            'difficulty' => 'required|in:easy,medium,hard',
            'type' => 'required|in:multiple,boolean',
        ];
    }
}
