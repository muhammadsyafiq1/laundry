<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal_sewa;

class JadwalSewaController extends Controller
{
    public function index() 
    {
    	$jadwalsewa = Jadwal_sewa::with('dataBuktiBayar.laundry')->get(); 
    	return view('dashboard.admin.jadwal_sewa.index', compact(['jadwalsewa']));
    }
}
