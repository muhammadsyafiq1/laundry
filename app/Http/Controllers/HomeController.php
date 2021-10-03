<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Data_bukti_bayar;
use App\Models\Laundry;
use App\Models\Transaction_detail;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // admin
        $totalPengguna  = User::count();
        // $totalPemasukan = Data_bukti_bayar::sum('nominal');
        $totalLaundry = Laundry::where('status_laundry','=','aktifkan')->count();
        // pemilik
        $totalLaundryKu = Laundry::where('user_id',Auth::user()->id)->count();

        // laundry yang pernah dibooking
        // pemilik
        $sellTransaction = Transaction_detail::with(['transaction.user','laundry.gallery'])->whereHas('laundry', function($laundry){
            $laundry->where('user_id', Auth::user()->id);
        })->get(); 

        // customer
        // riwayat laundry yang pernah di booking customer
        $buyTransaction = Transaction_detail::with(['transaction.user','laundry.gallery'])->whereHas('transaction', function($transaction){
            $transaction->where('user_id', Auth::user()->id);
        })->get(); 
        
        // total pendapatan pemilik laundry
        $transactions = Transaction_detail::with(['transaction.user','laundry.gallery'])
                                        ->whereHas('laundry', function($laundry){
                                        $laundry->where('user_id', Auth::user()->id);
                                    });
        $revenue = $transactions->get()->reduce(function ($carry, $item){
            return $carry + $item->total_harga;
        }); 

        return view('home',[
            'totalLaundryKu' => $totalLaundryKu,

            'totalPengguna' => $totalPengguna,
            'totalLaundry' => $totalLaundry,
            'sellTransaction' => $sellTransaction,
            'revenue' => $revenue
        ]);
    }
}
