<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction_detail;
use App\Models\Transaction;
use App\Models\Ulasan;
use Auth;
use PDF;
use DB;

class TransactionController extends Controller
{

    public function FunctionName($value='')
    {
        $TransaksiPending = App\Models\Transaction_detail::with(['transaction.user','laundry.gallery'])
            ->whereHas('laundry', function($laundry){$laundry->where('user_id', Auth::user()->id);})
            ->whereHas('transaction', function($laundry){$laundry->where('transaksi_status', '=' ,'pending');})
            ->count();
    }

    public function booking(Request $request)
    {

        $request->validate([
            'kilo' => 'max:10|min:1',
            'keterangan' => 'required',
            'alamat_jemput' => 'required',
            'rt' => 'required',
            'rw' => 'required'
        ]);

        // dd($request->hanya_gosok); die;

        $transaction = new Transaction;
        $transaction->user_id = Auth::user()->id;
        $transaction->harga_perkilo = $request->harga_perkilo;
        $transaction->transaksi_status = 'pending';
        $transaction->transaksi_code = 'Booking -'. mt_rand(100000,999999);
        $transaction->kilo = $request->kilo;
        $transaction->keterangan = $request->keterangan;
        $transaction->alamat_jemput = $request->alamat_jemput;
        $transaction->rt = $request->rt;
        $transaction->rw = $request->rw;
        if($request->hanya_gosok){
            $transaction->pilihan_laundry = 'gosok';
        }else {
            $transaction->pilihan_laundry = 'cuci gosok';
        }
        $transaction->save();

        if($request->hanya_gosok){
            $total_harga = $request->kilo * $request->harga_gosok; 
        }else {
            $total_harga = $request->harga_perkilo * $request->kilo + $request->gosok; 
        }

        Transaction_detail::create([
            'transaction_id' => $transaction->id,
            'total_harga' => $total_harga,
            'transaction_detail_code' => 'BookingDetail -'. mt_rand(100000,999999),
            'laundry_id' => $request->laundry_id,
        ]);

        return redirect()->route('success');
        
    }

    public function riwayat_pengguna()
    {
    	$sellTransaction = Transaction_detail::with(['transaction.user','laundry.gallery'])->whereHas('laundry', function($laundry){
            $laundry->where('user_id', Auth::user()->id);
        })->get(); 

    	return view('dashboard.transaction.pemilik.index', compact(['sellTransaction'])); dd($sellTransaction);
    }

    public function riwayat_laundry_saya()
    {
    	$buyTransaction = Transaction_detail::with(['transaction.user','laundry.gallery'])->whereHas('transaction', function($transaction){
            $transaction->where('user_id', Auth::user()->id);
        })->paginate(10);  

        return view('dashboard.customer.riwayat.index', compact(['buyTransaction']));
    }

    public function cetakPdf($id)
    {
        $transaksi_detail = Transaction_detail::with('transaction.user','laundry.gallery')->findOrFail($id); 
        $transaction = Transaction::findOrFail($transaksi_detail->transaction_id);
        $transaction->transaksi_status = 'dijemput';
        $transaction->save();
        $pdf = PDF::loadView('cetak_pdf', compact('transaksi_detail'))->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function updateStatusTerima(Request $request,$id,$laundryid)
    {
        $transaction = Transaction::findOrFail($id); 
        $transaction->transaksi_status = 'diterima';
        $transaction->save();

        $ulasan = new Ulasan;
        $ulasan->laundry_id = $laundryid;
        $ulasan->user_id = Auth::user()->id;
        $ulasan->ulasan = '';
        $ulasan->foto = '';
        $ulasan->status = 0;
        $ulasan->save();

        return redirect()->back()->with('status','Terimakaih sudah berlangganan dengan kami. Silahkan berikan ulasan anda tentang laundry kami pada menu ulasan.');
    }

    public function updateStatusSelesai(Request $request,$id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->transaksi_status = $request->status;
        $transaction->save();
        return redirect()->back()->with('status','Laundry telah siap dan segera diantar.');
    }

    public function remove($id)
    {
        $transaction_detail = Transaction_detail::with('transaction')->findOrFail($id);
        $transaction_id = Transaction::where('id',$transaction_detail->transaction->id)->firstOrFail();
        $transaction_detail->delete();
        $transaction_id->delete();
        return redirect()->back();
    }

}
