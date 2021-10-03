<?php

namespace App\Http\Controllers;

use App\Models\Laundry_gallery;
use App\Models\Laundry;
use Illuminate\Http\Request;

class LaundryGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laundries = Laundry::where('user_id', \Auth::user()->id)->get();
        $galleries = Laundry_gallery::with(['laundry'])->whereHas('laundry', function($laundry){
            $laundry->where('user_id', \Auth::user()->id) ;
        })->get();

        return view('dashboard.gallery.index', compact('galleries','laundries'));
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
            'foto' => 'required|image',
            'caption' => 'required|max:100|min:5',
            'laundry_id' => 'required'
        ]);

        $data = $request->all();
        $data['foto'] = $request->file('foto')->store('galleries','public');
        Laundry_gallery::create($data);
        return redirect()->back()->with('status','Gallery berhasil ditambhakan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Laundry_gallery  $laundry_gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Laundry_gallery $laundry_gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laundry_gallery  $laundry_gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Laundry_gallery $laundry_gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Laundry_gallery  $laundry_gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'foto' => 'image',
            'caption' => 'required|max:100|min:5',
            'laundry_id' => 'required'
        ]);
        $data = $request->all(); 
        if($request->hasFile('foto')){
            if($request->foto && file_exists(storage_path('app/public/',$request->foto))){
                \Storage::delete('public/',$request->foto);
            }
            $file = $request->file('foto')->store('galleries','public');
            $data['foto'] = $file;
        }
        $item = Laundry_gallery::findOrFail($id);
        $item->update($data);
        return redirect()->back()->with('status','Gallery berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laundry_gallery  $laundry_gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Laundry_gallery::findOrFail($id);
        $item->delete();
        return redirect()->back()->with('status','Gallery berhasil dihapus.');
    }
}
