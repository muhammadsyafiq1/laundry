<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data_bukti_bayar;
use App\Models\Laundry;
use App\Models\Pemberitahuan;
use App\Models\Jadwal_sewa;

class PemberitahuanController extends Controller
{

	public function index()
	{
		$pemberitahuan = Pemberitahuan::where('user_id',\Auth::user()->id)->get();
		return view('dashboard.pemberitahuan.index', compact(['pemberitahuan']));
	}

    public function accept(Request $request,$id)
    {
        // admin melakukan acc pada laundry terdaftar. dan membuat pemberitahuan pada pemilik laundry
        // kalau laundry telah didaftarkan
    	$dataBuktiBayar = Data_bukti_bayar::where('id',$request->id)->firstOrFail(); 
        $sewa_selama = $dataBuktiBayar->sewa_selama; 

        // ganti status bukti bayar berhasil
    	$dataBuktiBayar->status_bukti_pembayaran = $request->info; 
    	$dataBuktiBayar->save();


        // aktifkan status laundry
        $laundry = Laundry::where('id',$dataBuktiBayar->laundry_id)->firstOrFail();
        $laundry->status_laundry = 'aktif';
        $laundry->save();

        // jika berhasil tambahkan jadwal mulai sewa dan habis sewa
        // $jadwal_sewa = new Jadwal_sewa;
        // $jadwal_sewa->data_bayar_id = $dataBuktiBayar->id;
        // $jadwal_sewa->mulai_sewa = date('y-m-d');
        // $jadwal_sewa->habis_sewa = date('y-m-d',strtotime(" +".$sewa_selama." month ", time()));
        // $jadwal_sewa->save();

        // buat pemberitahuan ke pemilik laundry
    	Pemberitahuan::create([
    		'laundry_id' => $dataBuktiBayar->laundry_id,
    		'info' => $request->info,
    		'user_id' => $dataBuktiBayar->user_id,
    	]);

    	return redirect()->back()->with('status','laundry didaftarkan');
    }

    public function decline(Request $request,$id)
    {
        // admin melakukan penolakan pada bukti pembayaran. dan membuat pemberitahuan pada pemilik laundry
        // kalau bukti bayarnya ditolak
        $dataBuktiBayar = Data_bukti_bayar::where('id',$request->id)->firstOrFail();
        $dataBuktiBayar->status_bukti_pembayaran = 'ditolak'; 
        $dataBuktiBayar->save();

        // gagalkan status laundry
        $laundry = Laundry::where('id',$dataBuktiBayar->laundry_id)->firstOrFail();
        $laundry->status_laundry = 'gagal';
        $laundry->save();

        Pemberitahuan::create([
            'laundry_id' => $dataBuktiBayar->laundry_id,
            'info' => $request->info,
            'user_id' => $dataBuktiBayar->user_id,
        ]);
        return redirect()->back()->with('status','Pembayaran berhasil ditolak. status daftar laundry di non aktifkan');
    }

    public function dibaca(Request $request, $id)
    {
        $pemberitahun = Pemberitahuan::findOrFail($id);
        $pemberitahun->status = $request->status;
        $pemberitahun->save();
        return redirect()->back();
    }

    public function remove($id)
    {
        $item = Pemberitahuan::findOrFail($id);
        $item->delete();
        return redirect()->back();
    }
}
