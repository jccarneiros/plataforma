<?php

namespace App\Http\Requests\Administrations;

use Illuminate\Foundation\Http\FormRequest;

class ConfigurationsUpdateFormRequest extends FormRequest
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
            'app_name' => 'required|string|min:3|max:100',
            'app_email' => "required|email|unique:configurations,app_email,{$this->id},id",
            'app_cep' => 'required|string',
            'app_endereco' => 'required|string',
            'app_numero' => 'required|string',
            'app_bairro' => 'required|string',
            'app_cidade' => 'required|string',
            'app_estado' => 'required|string',
            'app_site' => 'nullable|string',
            'app_phone' => 'required|string',
            'app_whatsapp' => 'nullable|string',
            'app_author' => 'required|string',
            'app_url' => 'required|string',
            'app_debug' => 'required|string',
            'app_env' => 'required|string',
            'app_description' => 'required|string',
            'session_lifetime' => 'required|string',
            'session_expire_on_close' => 'required|string',
            'session_encrypt' => 'required|string',
            'app_enable_register' => 'required|string',
        ];
    }
}
