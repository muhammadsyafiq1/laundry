<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal_sewa extends Model
{
    use HasFactory;

    protected $fillable = [
    	'data_bayar_id','habis_sewa','mulai_sewa'	
    ];

    public function dataBuktiBayar()
    {
    	return $this->belongsTo(Data_bukti_bayar::class,'data_bayar_id');
    }
}
