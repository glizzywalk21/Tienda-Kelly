<?php
/***/
namespace App\Http\Controllers;

use App\Models\ReservationItem;
use App\Models\User;
use App\Models\Reservation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationController extends Controller
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
