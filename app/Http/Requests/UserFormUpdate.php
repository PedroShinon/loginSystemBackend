<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'max:255' ],
            'last_name' => ['required', 'max:255' ],
            'password' => ['nullable', 'min:6', 'confirmed' ],
            'password_confirmation' => ['nullable' ],
        ];
    }
    public function messages(): array
    {
        return [
            'first_name.required' => 'Um nome é requerido',
            'last_name.required' => 'Um sobrenome é requerido',
            'password.confirmed' => 'As senhas precisam ser iguais',
            'password.min' => 'Senha precisa ser maior que 6 chars',
            'password_confirmation.required' => 'Uma confirmação válida é requerida',
        ];
    }
}
