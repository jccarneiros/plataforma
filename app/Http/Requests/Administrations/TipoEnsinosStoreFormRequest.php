<?php

declare(strict_types=1);

namespace App\Http\Requests\Administrations;

use Illuminate\Foundation\Http\FormRequest;

/**
 * TipoEnsinosStoreFormRequest
 */
class TipoEnsinosStoreFormRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:100|unique:tipo_ensinos,name',
            'type' => 'required|string',
        ];
    }
}
