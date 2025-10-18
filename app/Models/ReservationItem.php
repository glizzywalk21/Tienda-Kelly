<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'fk_reservation',
        'fk_product',
        'quantity',
        'nombre',
        'subtotal',
        'precio',
        'fk_vendedors',
        'fk_mercados',
    ];

    protected $casts = [
        'fk_reservation' => 'integer',
        'fk_product'     => 'integer',
        'quantity'       => 'integer',
        'precio'         => 'decimal:2',
        'subtotal'       => 'decimal:2',
        'fk_vendedors'   => 'integer',
        'fk_mercados'    => 'integer',
    ];

    /** Relación con la reserva (padre) */
    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'fk_reservation');
    }

    /** Producto asociado a la línea */
    public function product()
    {
        return $this->belongsTo(Product::class, 'fk_product');
    }

    /** Vendedor que despacha el ítem */
    public function vendedor()
    {
        return $this->belongsTo(Vendedor::class, 'fk_vendedors');
    }

    /** Área del mercado (si guardas la FK directamente en la línea) */
    public function mercadoLocal()
    {
        return $this->belongsTo(MercadoLocal::class, 'fk_mercados');
    }

    /** Alias para compatibilidad con código previo que use 'mercados' */
    public function mercados()
    {
        return $this->mercadoLocal();
    }
}
