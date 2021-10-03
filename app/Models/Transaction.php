<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
    	'user_id','harga_perkilo','transaksi_status','transaksi_code','kilo','keterangan','alamat_jemput','rt','rw','notifikasi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transactiondetail()
    {
        return $this->hasMany(Transaction_detail::class, 'transaction_id');
    }
}

