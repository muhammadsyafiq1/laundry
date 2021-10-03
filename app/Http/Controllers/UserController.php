<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('dashboard.admin.list-user',compact(['users']));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('dashboard.profile.index', compact(['user']));
    }

    public function settingProfile()
    {
        $user = Auth::user();
        return view('dashboard.profile.setting-profile', compact(['user']));
    }

    public function gantiPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = User::findOrFail(Auth::user()->id);
        $user->password = \Hash::make($request->password);
        $user->save();
        return redirect()->back()->with('status','Password berhasil diubah');
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
        //
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
            'name' => 'required|min:4',
            'avatar' => 'image|nullable'
        ]);
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->alamat = $request->alamat;
        if($request->hasFile('avatar')){
            if($request->avatar && file_exists(storage_path('app/public/'.$request->avatar))){
                Storage::delete('public/'.$request->avatar);
            }
            $file = $request->file('avatar')->store('avatars','public');
            $user->avatar = $file;
        } 
        $user->save();
        return redirect()->back()->with('status','Profile berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrfail($id);
        $user->delete();
        return redirect()->back()->with('status','Pengguna berhasil dihapus!');
    }
}
