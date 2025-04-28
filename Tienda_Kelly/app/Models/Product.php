<?php
/***/
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $price
 * @property $created_at
 * @property $updated_at
 * @property $fk_vendedors
 *
 * @property Vendedor $vendedor
 * @property Cart[] $carts
 * @property ReservationItem[] $reservationItems
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Product extends Model
{
    public $timestamps = false;


    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
         'description',
          'price',
          'fk_vendedors',
           'clasificacion',
           'imagen_referencia',
           'estado'
        ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendedor()
    {
        return $this->belongsTo(\App\Models\Vendedor::class, 'fk_vendedors', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carts()
    {
        return $this->hasMany(\App\Models\Cart::class, 'id', 'fk_product');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservationItems()
    {
        return $this->hasMany(\App\Models\ReservationItem::class, 'id', 'fk_product');
    }


}
