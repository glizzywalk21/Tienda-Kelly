<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationItemRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Asegúrate de manejar la autorización si es necesario
    }

    public function rules()
    {
        // Determinamos si estamos actualizando o creando
        $rules = [
            'fk_reservation' => 'required|exists:reservations,id',
            'fk_product' => 'required|exists:products,id',
            'fk_vendedors' => 'required|exists:vendedors,id',
            'nombre' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:1',
            'subtotal' => 'required|numeric|min:0',
            'esstado' => 'nullable|string|max:255',
        ];

        if ($this->isMethod('post')) {
            // Reglas específicas para la creación si es necesario
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            // Reglas específicas para la actualización si es necesario
            // Puedes añadir validaciones para asegurarte de que los datos estén actualizados
        }

        return $rules;
    }
}
