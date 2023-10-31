<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFollowUpRequest extends FormRequest
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
            'observation' => 'required|string',
            'protocol_id' => 'exists:protocols,id',
        ];
    }
    public function messages()
    {
        return [
            'observation.required' => 'O campo observação é obrigatório',
        ];
    }
}
