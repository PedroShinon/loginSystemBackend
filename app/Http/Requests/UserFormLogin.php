<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormLogin extends FormRequest
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
            'email' => ['required', 'email', 'exists:users,email' , 'max:255' ],
            'password' => ['required', 'min:6' ],     
        ];
    }
    public function messages(): array
    {
        return [
            'email.required' => 'Um email é requerido',
            'email.email' => 'Formato inválido ex(exemplo@email.com)',
            'email.exists' => 'Credenciais Incorretas',
            'password.required' => 'Uma senha válida é requerida',
            'password.min' => 'Senha precisa ser maior que 6 chars',
            
        ];
    }
}
