<?php

namespace App\Http\Requests\Administrations;

use Illuminate\Foundation\Http\FormRequest;

class ClubesUpdateFormRequest extends FormRequest
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
            'name_clube' => "nullable|string|unique:clubes,name_clube,{$this->id},id",
            'sala_id' => "nullable|int|unique:clubes,sala_id,{$this->id},id",
            'president_id' => "nullable|int|unique:clubes,president_id,{$this->id},id",
        ];
    }
}
