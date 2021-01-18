<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $primaryKey = 'petID';
    protected $fillable = ['userID', 'petName', 'petType', 'petAge', 'petImage'];

    public $timestamps = false;

    public function User() {
        return $this->belongsTo(User::class);
    }
}
