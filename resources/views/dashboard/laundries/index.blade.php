@extends('layouts.app')

@section('title')
    Laundry
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        @if (session('status'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Diproses!</strong> &nbsp;{{session('status')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if (session('statusHapus'))
            <div class="alert alert-warning">
                {{session('statusHapus')}}
            </div>
        @endif
        <div class="float-right">
            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i>
                 Daftar Laundry
            </button>
        </div>
    </div>
</div>
<div class="row">
    @forelse ($laundries as $item)
    <div class="col-4">
        <div class="card-group">
            <div class="card mt-3">
                <img class="card-img-top" src="{{Storage::url($item->foto_laundry)}}" alt="{{$item->nama_laundry}}" style="object-fit: cover; height: 380px;">
                <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <a href="{{route('laundry.edit',$item->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>
                    </div>
                    <div>
                        <form action="{{route('laundry.destroy',$item->id)}}" method="post">
                            @csrf @method('delete')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin hapus {{$item->nama_laundry}}. ?')">
                                <i class="fa fa-trash"> Delete</i>
                            </button>
                        </form>
                    </div>
                </div>
                <h5 class="card-title mt-2">{{$item->nama_laundry}}</h5>
                <p class="card-text">
                    <h5 class="text-info">Rp. {{number_format($item->harga_kilo)}} &nbsp; Perkilo</h5>
                </p>
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="card-text"><small class="text-muted">{{\Carbon\Carbon::createFromTimeStamp(strtotime($item->created_at))->diffForHumans()}}</small></p>
                        
                    </div>
                    <div>
                        @if($item->status_laundry == 'diproses')
                            <span class="text-warning">Sedang Diproses</span>
                        @elseif($item->status_laundry == 'aktifkan')
                            <span class="text-success">Aktif</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    @empty
        <div class="row">
            <div class="col-12">
                <div class="alert alert-info">
                    Anda belum memiliki laundry.
                </div>
            </div>
        </div>
    @endforelse
</div>

{{-- modal tambah laundry--}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Form Tambah Laundry</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('laundry.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-4">
                        <label for="nama_laundry">Nama Laundry</label>
                        <input name="nama_laundry" type="text" class="form-control @error('nama_laundry') is-invalid @enderror" id="nama_laundry">
                        @error('nama_laundry')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-4">
                        <label for="hp_laundry">Hp Laundry</label>
                        <input name="hp_laundry" type="text" class="form-control @error('hp_laundry') is-invalid @enderror" id="hp_laundry">
                        @error('hp_laundry')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-4">
                        <label for="berdiri_sejak">Berdiri sejak</label>
                        <input name="berdiri_sejak" type="date" class="form-control @error('berdiri_sejak') is-invalid @enderror" id="berdiri_sejak">
                        @error('berdiri_sejak')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="lokasi_jemput">Wilayah Penjemputan</label>
                        <input name="lokasi_jemput" type="text" class="form-control @error('lokasi_jemput') is-invalid @enderror" id="lokasi_jemput">
                        @error('lokasi_jemput')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-4">
                        <label for="harga_kilo">Harga / kilo</label>
                        <input name="harga_kilo" type="text" class="form-control @error('harga_kilo') is-invalid @enderror" id="harga_kilo">
                        @error('harga_kilo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                     <div class="form-group col-4">
                        <label for="gosok">Harga Gosok</label>
                        <input name="gosok" type="text" class="form-control @error('gosok') is-invalid @enderror" id="gosok">
                        @error('gosok')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label for="foto_laundry">Foto Laundry</label>
                        <input name="foto_laundry" type="file" class="form-control @error('foto_laundry') is-invalid @enderror ">
                        @error('foto_laundry')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="deskripsi_laundry">Deskripsi</label>
                        <textarea name="deskripsi_laundry" id="editor" class="editor form-control @error('deskripsi_laundry') is-invalid @enderror"></textarea>
                        @error('deskripsi_laundry')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="alamat_laundry">Alamat Laundry</label>
                        <textarea name="alamat_laundry" id="alamat_laundry" class="form-control @error('alamat_laundry') is-invalid @enderror"></textarea>
                        @error('alamat_laundry')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
</div>


@endsection