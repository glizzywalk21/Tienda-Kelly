<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Cliente extends Authenticatable
{
    use HasFactory;

    protected $table = 'clientes'; // Nombre exacto de la tabla
    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'usuario',
        'password',
        'sexo',
        'ROL',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
