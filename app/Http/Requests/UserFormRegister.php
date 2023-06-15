<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class UserFormRegister extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'max:255' ],
            'last_name' => ['required', 'max:255' ],
            'email' => ['required', 'unique:users,email', 'email', 'max:255' ],
            'password' => ['required', 'min:6', 'confirmed' ],
            'password_confirmation' => ['required' ],
            
        ];
    }
    public function messages(): array
    {
        return [
            'first_name.required' => 'Um nome é requerido',
            'last_name.required' => 'Um sobrenome é requerido',
            'email.required' => 'Um email válido é requerido',
            'email.email' => 'Formato inválido ex(exemplo@email.com)',
            'email.unique' => 'Tente outro email',
            'password.required' => 'Uma senha válida é requerida',
            'password.confirmed' => 'As senhas precisam ser iguais',
            'password.min' => 'Senha precisa ser maior que 6 chars',
            'password_confirmation.required' => 'Uma confirmação válida é requerida',
            
        ];
    }
    
}
