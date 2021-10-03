<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemberitahuan extends Model
{
    use HasFactory;

    protected $fillable = [
    	'laundry_id','info','user_id'
    ];

    public function laundry()
    {
    	return $this->belongsTo(Laundry::class, 'laundry_id');
    }
}
