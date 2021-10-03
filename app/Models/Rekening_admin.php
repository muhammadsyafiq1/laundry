<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening_admin extends Model
{
    use HasFactory;

    protected $fillable = [
    	'nama_bank','no_rek','atas_nama'
    ];
}
