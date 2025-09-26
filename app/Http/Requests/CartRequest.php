<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CartRequest extends FormRequest
{

    /**
     * Determinar si el usuario esta autorizado a hacer este request
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Obtener la validadcion de las reglas que aplican al request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

     public function rules(): array
     {
        return[
            'name' => 'required|string',
        ];
     }

}
