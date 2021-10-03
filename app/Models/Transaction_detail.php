<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction_detail extends Model
{
    use HasFactory;

    protected $fillable = [
    	'laundry_id','transaction_id','total_harga','transaction_detail_code'
    ];


    public function transaction()
    {
        return $this->hasOne(Transaction::class , 'id' , 'transaction_id');
    }

    public function laundry()
    {
        return $this->hasOne(Laundry::class , 'id' , 'laundry_id');
    }
}

