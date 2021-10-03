@extends('layouts.app')

@section('title')
    Dashbaord
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
          <li class="breadcrumb-item"><a href="{{route('riwayat-laundry-saya')}}">Data laundry saya</a></li>
          <li class="breadcrumb-item">Ulasan Saya</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
@foreach($ulasanSaya as $ulasan)
  <div class="card"> 
    <div class="row mb-2">
        <div class="col-lg-12">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <img src="{{asset('storage/'.$ulasan->laundry->foto_laundry)}}" style="width: 80px;">
              </div>
              <div>
                {{$ulasan->laundry->nama_laundry}}
              </div>
              <div>
                @if($ulasan->status == 0)
                  <a href="#" data-toggle="modal" data-target="#ulasan{{$ulasan->id}}" class="btn btn-warning btn-sm" >
                   Beri Ulasan
                  </a>
                @else
                  <a class="btn btn-danger btn-sm disabled">
                     Ulasan Telah Dibuat
                  </a>
                  <a href="#" data-toggle="modal" data-target="#view{{$ulasan->id}}" class="btn btn-success btn-sm">
                    Lihat Ulasan
                  </a>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    {{-- modal ulasan --}}
    <div class="modal fade" id="ulasan{{$ulasan->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="editLabel">Berikan ulasan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="{{route('ulasan-create',$ulasan->id)}}" method="post" enctype="multipart/form-data">
            @csrf 
                <div class="modal-body">
                  <div class="row">
                    <div class="form-group col-12">
                      <label>Foto</label>
                      <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" autocomplete>
                      @error('foto')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                    <div class="form-group col-12">
                      <label>Ulasan anda</label>
                      <textarea name="ulasan" type="ulasan" class="form-control @error('ulasan') is-invalid @enderror " autocomplete></textarea>
                      @error('ulasan')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="form-group col-12">
                  <button type="submit" class="btn btn-primary btn-block">Save</button>
                  <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    {{-- modal view ulasan --}}
    <div class="modal fade" id="view{{$ulasan->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="editLabel"> Lihat Ulasan - {{$ulasan->laundry->nama_laundry}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="{{route('ulasan-create',$ulasan->id)}}" method="post" enctype="multipart/form-data">
            @csrf 
                <div class="modal-body">
                  <div class="row">
                   <!--  <div class="form-group col-12">
                      <label>Foto</label> <br>
                      @if($ulasan->foto)
                        <img src="{{Storage::url($ulasan->foto)}}" style="width: 200px;">
                      @else
                        Tidak ada foto
                      @endif
                    </div> -->
                    <div class="form-group col-12">
                      <label>Ulasan anda</label>
                      <textarea class="form-control" readonly>{{$ulasan->ulasan}}</textarea>
                    </div>
                  </div>
                </div>
                <div class="form-group col-12">
                  <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
        </div>
    </div>
  @endforeach
@endsection
