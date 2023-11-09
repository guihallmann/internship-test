<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditUserRequest extends FormRequest
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
            'email' => 'required|email',
            'cpf' => ['required','cpf', Rule::unique('users')->ignore(request()->id)],
            'role' => 'required|in:Ti,Sys,Op',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'email.required' => 'O campo email é obrigatório',
            'email.email' => 'Informe um endereço de email válido',
            'cpf.required' => 'O campo CPF é obrigatório',
            'cpf.cpf' => 'Informe um CPF válido',
            'cpf.unique' => 'CPF já cadastrado',
            'role.required' => 'O campo cargo é obrigatório',
            'role.in' => 'Informe um cargo válido',
        ];
    }

    protected function cleanCpf()
    {
        $cpf = $this->input('cpf');
        $cleanedCpf = str_replace(['.', '-'], '', $cpf);
        $this->merge(['cpf' => $cleanedCpf]);
    }
}
