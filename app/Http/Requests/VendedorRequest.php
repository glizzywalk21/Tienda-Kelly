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
    public function rules()
    {
        $rules = [
            'usuario' => 'required|email|unique:vendedors,usuario,' . $this->id,
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'nombre_del_local' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'numero_puesto' => 'nullable|integer|unique:vendedors,numero_puesto,' . $this->id,
            'fk_mercado' => 'nullable|exists:mercado_locals,id',
            'imagen_de_referencia' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
        $rules['password'] = 'nullable|string|min:8|confirmed';
        } else {
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        return $rules;
    }
}
