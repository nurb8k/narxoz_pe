<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
//            i need check identifier first letter is S or F
            'identifier' => ['required', 'string', 'max:255','regex:/^[S|s|f|F]/'],
            'password' => ['required', 'string', 'min:6'],
        ];
    }
}