<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProtocolRequest extends FormRequest
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
            'description' => 'required|string',
            'deadline' => 'required|integer',
            'person_id' => 'required|exists:people,id',
            'department_id' => 'required|exists:departments,id'
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'O campo desrição é obrigatório',
            'deadline.required' => 'O campo prazo é obrigatório',
            'deadline.integer' => 'O campo prazo deve ser um número',
            'person_id.required' => 'O campo contribuinte é obrigatório',
            'department_id.required' => 'O campo departamento é obrigatório',
        ];
    }
}
