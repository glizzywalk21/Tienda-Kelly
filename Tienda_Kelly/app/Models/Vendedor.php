<?php
/***/
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class Vendedor
 *
 * @property $id
 * @property $usuario
 * @property $ROL
 * @property $password
 * @property $nombre
 * @property $nombre_del_local
 * @property $imagen_de_referencia
 * @property $clasificacion
 * @property $apellidos
 * @property $telefono
 * @property $numero_puesto
 * @property $fk_mercado
 * @property $created_at
 * @property $updated_at
 *
 * @property MercadoLocal $mercadoLocal
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Vendedor extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usuario',
        'ROL',
        'password',
        'nombre',
        'nombre_del_local',
        'imagen_de_referencia',
        'clasificacion',
        'apellidos',
        'telefono',
        'numero_puesto',
        'fk_mercado'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mercadoLocal()
    {
        return $this->belongsTo(\App\Models\MercadoLocal::class, 'fk_mercado', 'id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'fk_vendedor');
    }
    public function reservationitem(){
        return $this->hasMany(ReservationItem::class, 'fk_vendedors');
    }
}
