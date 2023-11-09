<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\UniqueCPF;

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
        $this->cleanCpf();
        return [
            'name' => 'required|string',
            'birthday' => 'required|date',
            'cpf' => ['required','cpf', Rule::unique('users')->ignore(request()->id), Rule::unique('people')->ignore(request()->id)],
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
            'cpf.unique' => 'CPF já cadastrado',
            'cpf.required' => 'O campo CPF é obrigatório',
            'cpf.cpf' => 'Informe um CPF válido',
        ];
    }

    protected function cleanCpf()
    {
        $cpf = $this->input('cpf');
        $cleanedCpf = str_replace(['.', '-'], '', $cpf);
        $this->merge(['cpf' => $cleanedCpf]);
    }
}
