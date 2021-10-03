<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data_bukti_bayar extends Model
{
    use HasFactory;

    protected $fillable = [
    	'rekening_id','sewa_selama','laundry_id','keteranagn','bukti_bayar','user_id','nominal','code_transfer','status_bukti_pembayaran'
    ];

    public function laundry()
    {
    	return $this->hasOne(Laundry::class, 'id' ,'laundry_id');
    }

    public function rekening()
    {
    	return $this->belongsTo(Rekening_admin::class, 'rekening_id');
    }
}
