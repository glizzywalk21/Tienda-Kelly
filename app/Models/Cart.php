<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'fk_product',
        'fk_user',
        'subtotal',
        'quantity',
        'talla',
    ];

    public function product()
    {
        // tu columna es fk_product
        return $this->belongsTo(Product::class, 'fk_product');
    }

    public function user()
    {
        // IMPORTANTE: tu columna es fk_user (no user_id)
        return $this->belongsTo(User::class, 'fk_user');
    }
}