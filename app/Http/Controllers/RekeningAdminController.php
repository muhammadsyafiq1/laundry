<?php

namespace App\Http\Controllers;

use App\Models\Rekening_admin;
use Illuminate\Http\Request;

class RekeningAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reks = Rekening_admin::all();
        return view('dashboard.admin.rekening.index', compact(['reks']));
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
        $data = $request->all();
        Rekening_admin::create($data);
        return redirect()->back()->with('status','Rekening berhasil ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rekening_admin  $rekening_admin
     * @return \Illuminate\Http\Response
     */
    public function show(Rekening_admin $rekening_admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rekening_admin  $rekening_admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Rekening_admin $rekening_admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rekening_admin  $rekening_admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $item = Rekening_admin::findOrFail($id);
        $item->update($data);
        return redirect()->back()->with('status','Rekening berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rekening_admin  $rekening_admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Rekening_admin::findOrFail($id);
        $item->delete();
        return redirect()->back()->with('status','Rekening berhasil dihapus');
    }
}
