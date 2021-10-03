@extends('layouts.app')

@section('title')
    Edit Laundry
@endsection

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        @if (Auth::user()->roles == 1)
          <h1 class="m-0">Dashboard Admin</h1>
        @elseif(Auth::user()->roles == 2)
          <h1 class="m-0">Dashboard Pemilik</h1>
        @else
          <h1 class="m-0">Dashboard Customer</h1>
        @endif
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('laundry.index')}}">Laundry</a></li>
            <li class="breadcrumb-item">Edit {{$item->nama_laundry}}</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @if (session('status'))
                <div class="alert alert-success">
                    {{session('status')}}
                </div>
            @endif
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div>
                <h5>Edit {{$item->nama_laundry}}</h5>
            </div>
            <div class="text-warning text-uppercase">
                Status laundy - {{$item->status_laundry}}
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <form action="{{route('laundry.update',$item->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf @method('put')
                        <div class="row">
                            <div class="col-5">
                                <img src="{{asset('storage/'.$item->foto_laundry)}}" class="w-100">
                                <input type="file" name="foto_laundry"> <br>
                                <i class="text-danger">Kosongkan bila tidak ingin diubah.</i>
                            </div>
                            <div class="col-7">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="nama_laundry">Nama Laundry</label>
                                        <input type="text" name="nama_laundry" class="form-control @error('nama_laundry') is-invalid @enderror" value="{{old('nama_laundry') ? old('nama_laundry') : $item->nama_laundry}}">
                                        @error('nama_laundry')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="hp_laundry">Nomor Hp Laundry</label>
                                        <input type="text" name="hp_laundry" class="form-control @error('hp_laundry') is-invalid @enderror" value="{{old('hp_laundry') ? old('hp_laundry') : $item->hp_laundry}}">
                                        @error('hp_laundry')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="harga_kilo">Harga / kilo</label>
                                        <input value="{{old('harga_kilo') ? old('harga_kilo') : $item->harga_kilo}}" name="harga_kilo" type="text" class="form-control @error('harga_kilo') is-invalid @enderror" id="harga_kilo">
                                        @error('harga_kilo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        @error('harga_kilo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                  <div class="row">
                                    <div class="form-group col-12">
                                        <label for="lokasi_jemput">Lokasi Penjemputan</label>
                                        <input type="text" name="lokasi_jemput" class="form-control @error('lokasi_jemput') is-invalid @enderror" value="{{old('lokasi_jemput') ? old('lokasi_jemput') : $item->lokasi_jemput}}">
                                        @error('lokasi_jemput')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="deskripsi_laundry">Deskripsi</label>
                                        <textarea name="deskripsi_laundry" id="deskripsi_laundry" class="form-control @error('deskripsi_laundry') is-invalid @enderror">{{old('deskripsi_laundry') ? old('deskripsi_laundry') : $item->deskripsi_laundry}}</textarea>
                                        @error('deskripsi_laundry')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="alamat_laundry">Alamat Detail</label>
                                        <textarea name="alamat_laundry" id="alamat_laundry" class="form-control @error('alamat_laundry') is-invalid @enderror">{{old('alamat_laundry') ? old('alamat_laundry') : $item->alamat_laundry}}</textarea>
                                        @error('alamat_laundry')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <button class="btn-block btn btn-primary btn-sm" type="submit">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection