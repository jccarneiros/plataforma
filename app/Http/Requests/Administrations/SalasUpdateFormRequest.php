<?php

namespace App\Http\Requests\Administrations;

use Illuminate\Foundation\Http\FormRequest;

class SalasUpdateFormRequest extends FormRequest
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
            'name' => "required|string|unique:salas,name,{$this->id},id",
            'user_id' => "nullable|string|unique:salas,user_id,{$this->id},id",
            'president_id' => "nullable|string|unique:salas,president_id,{$this->id},id",
        ];
    }
}
