<?php

namespace App\Http\Requests\Administrations;

use Illuminate\Foundation\Http\FormRequest;

class PresidentsUpdateFormRequest extends FormRequest
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
            'user_id' => "nullable|int|unique:presidents,user_id,{$this->id},id",
            'name_clube' => "required|string|unique:presidents,name_clube,{$this->id},id",
        ];
    }
}
