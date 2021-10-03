<?php

namespace App\Http\Controllers;

use App\Models\Laundry;
// use App\Models\Rekening_admin;
use Illuminate\Http\Request;

class LaundryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $reks = Rekening_admin::all();
        $laundries = Laundry::where('user_id', \Auth::user()->id)->get();
        return view('dashboard.laundries.index', compact(['laundries']));
    }

    public function tableLaundry()
    {
        $laundries = Laundry::with(['user'])->get();
        return view('dashboard.laundries.admin.index', compact(['laundries']));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_laundry' => 'required|min:3',
            'alamat_laundry' => 'required',
            'deskripsi_laundry' => 'required',
            'hp_laundry' => 'required',
            'foto_laundry' => 'image',
            'harga_kilo' => 'required',
            'berdiri_sejak' => 'required',
        ]);
        $data = $request->all(); 
        // $data['nama_laundry'] = $request->nama_laundry;
        $data['slug_laundry'] = \Str::slug($request->nama_laundry);
        $data['user_id'] = \Auth::user()->id;
        $data['foto_laundry'] = $request->file('foto_laundry')->store('laundry_image','public');
        Laundry::create($data);
        return redirect()->back()->with('status','Laundry berhasil ditambahkan dan sedang diproses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Laundry  $laundry
     * @return \Illuminate\Http\Response
     */
    public function show(Laundry $laundry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laundry  $laundry
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Laundry::findOrFail($id);
        return view('dashboard.laundries.edit', compact(['item']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Laundry  $laundry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_laundry' => 'required|min:5',
            'alamat_laundry' => 'required',
            'deskripsi_laundry' => 'required',
            'hp_laundry' => 'required',
            'foto_laundry' => 'image|nullable',
            'harga_kilo' => 'required',
            'berdiri_sejak' => 'nullable',
            'lokasi_jemput' => 'required'
        ]);
        $data = $request->all(); 
        $data['slug'] = \Str::slug($request->nama_laundry);
        if($request->hasFile('foto_laundry')){
            if($request->foto_laundry && file_exists(storage_path('app/public/',$request->foto_laundry))){
                \Storage::delete('public/',$request->foto_laundry);
            }
            $file = $request->file('foto_laundry')->store('laundry_image','public');
            $data['foto_laundry'] = $file;
        }
        $item = Laundry::findOrFail($id);
        $item->update($data);
        return redirect()->back()->with('status','Laundry berhasil diubah.');
    }

    public function aktif(Request $request ,$id)
    {
        $laundry = Laundry::findOrFail($id);
        $laundry->status_laundry = $request->status;
        $laundry->save();
        return redirect()->back()->with('status','Laundry diaktifkan');
    }

    public function nonaktif(Request $request ,$id)
    {
        $laundry = Laundry::findOrFail($id);
        $laundry->status_laundry = $request->status;
        $laundry->save();
        return redirect()->back()->with('status','Laundry di nonaktifkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laundry  $laundry
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Laundry::findOrFail($id);
        $item->delete();
        return redirect()->back()->with('statusHapus','Laundry berhasil dihapus.');
    }
}
