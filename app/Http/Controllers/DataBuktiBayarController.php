<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data_bukti_bayar;
use App\Models\Rekening_admin;
use App\Models\Laundry;

class DataBuktiBayarController extends Controller
{

    public function index()
    {
        $transferall = Data_bukti_bayar::with('laundry.user','rekening')->get(); 
        $transfers = Data_bukti_bayar::with(['laundry.user','rekening'])->where('user_id',\Auth::user()->id)->get();
        return view('dashboard.transfer.index', compact(['transfers','transferall']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nominal' => 'required',
            'sewa_selama' => 'required',
            'keteranagn' => 'required',
            'bukti_bayar' => 'image',
        ]);

    	$data = $request->all();

    	$laundry = Laundry::where('id', $request->laundry_id)->firstOrFail();
    	$laundry->status_laundry = 'dibayar';
    	$laundry->save();

    	$data['bukti_bayar'] = $request->file('bukti_bayar')->store('bukti_bayar','public');
        $data['code_transfer'] = 'Code -'. mt_rand(100000,999999);
    	Data_bukti_bayar::create($data);
    	return redirect()->back()->with('status','Pemabayaran berhasil. Pemabayaran akan di cek oleh admin.');
    }
}
