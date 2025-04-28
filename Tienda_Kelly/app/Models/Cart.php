<?php
/***/
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'fk_product',
        'fk_user',
        'subtotal', // Añadimos fk_user a los campos fillable
        'quantity',
    ];

    public function product()
{
    return $this->belongsTo(Product::class, 'fk_product');
}


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

