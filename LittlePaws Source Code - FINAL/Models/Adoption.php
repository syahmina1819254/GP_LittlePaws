<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adoption extends Model
{
    use HasFactory;

    protected $primaryKey = 'adoptID';
    protected $fillable = ['userID', 'petID', 'reqDate', 'reqStatus'];

    public $timestamps = false;

    public function User(){
        return $this->belongsTo(User::class);
    }
}
