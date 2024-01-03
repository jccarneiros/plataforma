<?php

namespace App\Http\Requests\Administrations;

use Illuminate\Foundation\Http\FormRequest;

class PresidentsStoreFormRequest extends FormRequest
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
            'sala_id' =>  'required|int|unique:presidents,sala_id',
            'user_id' =>  'required|int|unique:presidents,user_id',
            'name_clube' =>  'required|string|unique:presidents,name_clube',
            'limit_clube_students' =>  'required',

        ];
    }
}
