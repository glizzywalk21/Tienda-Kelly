<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendedorRequest extends FormRequest
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
			'usuario' => 'required|string',
			'password' => 'required|string',
			'nombre' => 'required|string',
			'apellidos' => 'string',
			'telefono' => 'string',
			'numero_puesto' => 'required',
			'fk_mercado' => 'required',
        ];
    }
}
