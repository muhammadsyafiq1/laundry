<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laundry;
use App\Models\Banner;
use App\Models\Laundry_gallery;
use App\Models\Transaction;
use App\Models\Transaction_detail;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $banners = Banner::all(); 
        $filterKeyword = $request->keyword; 
        if($filterKeyword){
            $laundries = 
                Laundry::where('deskripsi_laundry','LIKE',"%$filterKeyword%")
                        ->orWhere('nama_laundry', 'LIKE' , "%$filterKeyword%")
                        ->orWhere('alamat_laundry', 'LIKE' , "%$filterKeyword%")
                        ->where('status_laundry', 'aktifkan')->get();
        } else {
            $laundries = Laundry::where('status_laundry', 'aktifkan')->get(); 
        }
    	return view('home.index', compact(['laundries','banners']));
    }

    public function detail($slug)
    {
    	$laundry = Laundry::with(['ulasan.user'])->where('slug_laundry', $slug)->firstOrFail();
        $galleries = Laundry_gallery::where('laundry_id', $laundry->id)->paginate(8);
    	return view('home.detail', compact(['laundry','galleries']));
    }

    public function bookingLaundry(Request $request)
    {
        $request->validate([
            'kilo' => 'max:100|min:1',
            'keterangan' => 'required',
            'alamat_jemput' => 'required',
            'rt' => 'required',
            'rw' => 'required'
        ]);

        // dd($request->all); die();

        $transaction = new Transaction;
        $transaction->user_id = \Auth::user()->id;
        $transaction->harga_perkilo = $request->harga_perkilo;
        $transaction->transaksi_status = 'pending';
        $transaction->transaksi_code = 'Booking -'. mt_rand(100000,999999);
        $transaction->kilo = $request->kilo;
        $transaction->keterangan = $request->keterangan;
        $transaction->alamat_jemput = $request->alamat_jemput;
        $transaction->rt = $request->rt;
        $transaction->rw = $request->rw;
        $transaction->save();

        $total_harga = $request->harga_perkilo * $request->kilo; 

        Transaction_detail::create([
            'transaction_id' => $transaction->id,
            'total_harga' => $total_harga,
            'transaction_detail_code' => 'BookingDetail -'. mt_rand(100000,999999),
            'laundry_id' => $request->laundry_id,
        ]);

        return redirect()->route('success');
    }

    public function success()
    {
        return view('home.success');
    }
}
