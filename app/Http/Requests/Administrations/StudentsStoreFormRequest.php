<?php

namespace App\Http\Requests\Administrations;

use Illuminate\Foundation\Http\FormRequest;

class StudentsStoreFormRequest extends FormRequest
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
            'tipo_ensino_id' => 'required',
            'serie_id' => 'required',
            'room_id' => 'required',
            'name' => 'required|string',
            'number' => 'required|string',
            'number_ra' => 'required|string|min:9|max:9',
            'number_ra_digit' => 'required|string|min:1|max:1',
            'date_birth' => 'required|string',
        ];
    }
}
