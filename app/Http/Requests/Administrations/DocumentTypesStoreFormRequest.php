<?php
declare(strict_types=1);

namespace App\Http\Requests\Administrations;

use Illuminate\Foundation\Http\FormRequest;

/**
 * DocumentTypesStoreFormRequest
 */
class DocumentTypesStoreFormRequest extends FormRequest
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
            'area_conhecimento_id' => 'required',
            'name' => 'required|string',
            'periodicidade' => 'required|string',
        ];
    }
}
