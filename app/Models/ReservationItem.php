<?php
/***/
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationItem extends Model
{
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

    public function product()
    {
        return $this->belongsTo(Product::class, 'fk_product');
    }
    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'fk_reservation');
    }
    public function vendedor()
    {
        return $this->belongsTo(Vendedor::class, 'fk_vendedors');
    }
    public function mercados()
    {
        return $this->belongsTo(MercadoLocal::class, 'fk_mercados');
    }
}

