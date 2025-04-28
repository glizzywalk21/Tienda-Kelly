<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MercadoLocalRequest extends FormRequest
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
			'nombre' => 'required|string',
			'imagen_referencia' => 'required',
			'municipio' => 'required|string',
			'ubicacion' => 'required|string',
			'horaentrada' => 'required|',
			'horasalida' => 'required|',
			'descripcion' => 'required|string',
        ];
    }
}
