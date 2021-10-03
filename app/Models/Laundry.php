<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laundry extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'user_id','nama_laundry','alamat_laundry','deskripsi_laundry','hp_laundry','slug_laundry',
        'foto_laundry','harga_kilo','berdiri_sejak','lokasi_jemput','gosok','pilihan_laundry',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id','user_id');
    }


    public function dataBayar()
    {
        return $this->hasOne(Data_bukti_bayar::class ,'laundry_id');
    }

    public function gallery()
    {
        return $this->hasMany(Laundry_gallery::class ,'laundry_id');
    }


    public function ulasan()
    {
        return $this->hasMany(Ulasan::class ,'laundry_id');
    }

}
