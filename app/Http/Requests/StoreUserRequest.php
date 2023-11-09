<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
        $this->cleanCpf();
        return [
            'name' => 'required|string',
            'email' => ['required','email', Rule::unique('users')->ignore(request()->id)],
            'cpf' => ['required','cpf', Rule::unique('users')->ignore(request()->id), Rule::unique('people')->ignore(request()->id)],
            'role' => 'required|in:Ti,Sys,Op',
            'password' => 'required|min:6|max:20'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'email.required' => 'O campo email é obrigatório',
            'email.email' => 'Informe um endereço de email válido',
            'email.unique' => 'Email já cadastrado',
            'cpf.unique' => 'CPF já cadastrado',
            'cpf.required' => 'O campo CPF é obrigatório',
            'cpf.cpf' => 'Informe um CPF válido',
            'role.required' => 'O campo cargo é obrigatório',
            'role.in' => 'Informe um cargo válido',
            'password.required' => 'O campo senha é obrigatório',
            'password.min' => 'A senha deve ter no mínimo :min caracteres',
            'password.max' => 'A senha deve ter no máximo :max caracteres',
        ];
    }

    protected function cleanCpf()
    {
        $cpf = $this->input('cpf');
        $cleanedCpf = str_replace(['.', '-'], '', $cpf);
        $this->merge(['cpf' => $cleanedCpf]);
    }
}
