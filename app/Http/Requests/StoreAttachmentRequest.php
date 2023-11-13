<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttachmentRequest extends FormRequest
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
            'files.*' => 'mimes:jpg,jpeg,pdf,png|max:3072',
            'files' => 'max:5'
        ];
    }

    public function messages()
    {
        return [
            'files.*.mimes' => 'Apenas arquivos JPG, JPEG, PNG ou PDF',
            'files.*.max' => 'Apenas arquivos de até 3MB',
            'files.max' => 'Carregue no máximo 5 arquivos'
        ];
    }
}
