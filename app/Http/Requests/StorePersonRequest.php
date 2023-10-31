<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePersonRequest extends FormRequest
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
            'name' => 'required|string',
            'birthday' => 'required|date',
            'cpf' => ['required','cpf', Rule::unique('users')->ignore(request()->id)],
            'sex' => 'required|in:Masculino,Feminino,Outro',
            'city' => 'nullable|string',
            'neighborhood' => 'nullable|string',
            'street' => 'nullable|string',
            'number' => 'nullable|string',
            'complement' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "O campo nome é obrigatório",
            'birthday.required' => "O campo data de nascimento é obrigatório",
            'sex.required' => "O campo sexo é obrigatório",
            'cpf.required' => 'O campo CPF é obrigatório',
            'cpf.cpf' => 'Informe um CPF válido',
            'cpf.unique' => 'CPF já cadastrado',
        ];
    }
}
