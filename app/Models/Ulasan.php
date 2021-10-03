<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $fillable = [
    	'user_id','laundry_id','foto','ulasan'
    ];

    public function laundry()
    {
    	return $this->belongsTo(Laundry::class, 'laundry_id');
    }

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }
}
