<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ulasan;
use Auth;

class UlasanController extends Controller
{
	public function index()
	{
		$ulasanSaya = Ulasan::with('laundry')->where('user_id', Auth::user()->id)->get();
		return view('dashboard.customer.ulasan.index', compact('ulasanSaya'));
	}

	public function store(Request $request, $id)
	{
		$request->validate([
			'foto' => 'image',
			'ulasan' => 'required'
		]);

		$ulasan  = Ulasan::findOrFail($id);
		$ulasan->ulasan = $request->ulasan;
		// dd($request->ulasan); die;
		$ulasan->status = 1;
		if($request->hasFile('foto')){
			$file = $request->file('foto')->store('ulasans','public');
           	$ulasan->foto = $file;
		}
		$ulasan->save();

		return redirect()->back();
	}
}
