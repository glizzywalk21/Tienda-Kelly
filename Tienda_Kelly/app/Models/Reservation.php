<?php
/***/
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'fk_user',
        'total',
        'estado',
        'retiro',

    ];

    public function items()
    {
        return $this->hasMany(ReservationItem::class, 'fk_reservation');
    }
    public function user(){
        return $this->belongsTo(User::class, 'fk_user');
    }

}
