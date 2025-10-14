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
        $rules = [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:220',
        ];

        if ($this->isMethod('PATCH') || $this->isMethod('PUT')) {
            $rules['imagen_referencia'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        } else {
            $rules['imagen_referencia'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
        return $rules;
    }
}
