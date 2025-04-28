<?php
/***/
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class MercadoLocal
 *
 * @property $id
 * @property $nombre
 * @property $ROL
 * @property $imagen_referencia
 * @property $municipio
 * @property $ubicacion
 * @property $horaentrada
 * @property $horasalida
 * @property $descripcion
 * @property $created_at
 * @property $updated_at
 *
 * @property Vendedor[] $vendedors
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class MercadoLocal extends Authenticatable
{

    protected $table = 'mercado_locals';

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usuario','password','nombre', 'ROL', 'imagen_referencia', 'municipio', 'ubicacion', 'horaentrada', 'horasalida', 'descripcion'
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vendedors()
    {
        return $this->hasMany(\App\Models\Vendedor::class, 'fk_mercado', 'id');
    }


}
