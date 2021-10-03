<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laundry_gallery extends Model
{
    use HasFactory;
    protected $fillable = [
    	'laundry_id','caption','foto'
    ];

    public function laundry()
    {
    	return $this->belongsTo(Laundry::class, 'laundry_id');
    }
}
