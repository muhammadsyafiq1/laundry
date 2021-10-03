<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::all();
        return view('dashboard.admin.banner.index', compact('banners'));

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
            'title' => 'required',
            'sub_title' => 'required',
            'banner' => 'required|image'
        ]);

        $data = $request->all(); 
        $data['banner'] = $request->file('banner')->store('banners_image','public');
        $data['is_active'] = 0;
        Banner::create($data);
        return redirect()->back()->with('status','Banner berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $request->validate([
            'title' => 'required',
            'sub_title' => 'required',
            'banner' => 'image|size:9000'
        ]);

        $banner = Banner::findOrFail($id);
        $banner->title = $request->title;
        $banner->sub_title = $request->sub_title;
        $banner->is_active = 0;
        if($request->hasFile('banner')){
            if($request->banner && file_exists(storage_path('app/public/'.$request->banner))){
                Storage::delete('public/'.$request->banner);
            }
            $file = $request->file('banner')->store('banners_image','public');
            $banner->banner = $file;
        } 
        $banner->save();
        return redirect()->back()->with('status','Banner berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Banner::findOrFail($id);
        $item->delete();
        return redirect()->back()->with('status','Banner berhasil dihapus');
    }
}
