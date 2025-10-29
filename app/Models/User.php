<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /** =====================================================
     *  CAMPOS PERMITIDOS
     *  ===================================================== */
    protected $fillable = [
        'usuario',
        'password',
        'nombre',
        'apellido',
        'telefono',
        'sexo',
        'imagen_perfil',
        'ROL',
    ];

    /** =====================================================
     *  CAMPOS OCULTOS EN RESPUESTAS
     *  ===================================================== */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /** =====================================================
     *  CASTS Y ATRIBUTOS EXTRAS
     *  ===================================================== */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'avatar_url',
    ];

    /** =====================================================
     *  RELACIONES
     *  ===================================================== */
    public function sessions()
    {
        return $this->hasMany(\App\Models\Session::class, 'user_id');
    }

    public function reservas()
    {
        return $this->hasMany(Reservation::class, 'fk_user');
    }

    /** =====================================================
     *  GETTER PARA AVATAR
     *  ===================================================== */
    public function getAvatarUrlAttribute(): string
    {
        $ruta = $this->imagen_perfil;
        $fallback = asset('images/default-avatar.jpg');

        if (!$ruta) {
            return $fallback;
        }

        // URL absoluta (por si viene de red externa)
        if (Str::startsWith($ruta, ['http://', 'https://'])) {
            return $ruta;
        }

        // Quita una posible "/" inicial
        $ruta = ltrim($ruta, '/');

        // Soporta "images/archivo.png" o solo "archivo.png"
        if (Str::startsWith($ruta, 'images/')) {
            return asset($ruta);
        }

        return asset('images/' . $ruta);
    }
}
