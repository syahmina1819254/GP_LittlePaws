<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'hotelID';
    protected $fillable = ['hotelType', 'maxPetQty', 'hotelPrice'];

    public function Reservation(){
        return $this->hasMany(Reservation::class);
    }
}
