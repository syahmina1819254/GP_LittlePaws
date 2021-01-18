<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $primaryKey = 'bookID';
    protected $fillable = ['hotelID', 'userID', 'petQty', 'checkInDate', 'checkOutDate', 'payMethod', 'payAmt'];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Hotel(){
        return $this->belongsTo(Hotel::class);
    }
}
