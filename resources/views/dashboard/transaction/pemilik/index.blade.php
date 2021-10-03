@extends('layouts.app')

@section('title')
	Riwayat pengguna laundry
@stop

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
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item">Riwayat pengguna laundry</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@stop

@section('content')
 <div class="card">
    @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif
    <!-- /.card-header -->
    <div class="card-body">
      <table id="table_id" class="table table-striped">
        <thead>
            <tr>
                <th>Avatar</th>
                <th>Nama customer</th>
                <th>Laundry</th>
                <th>Pilihan Laundry</th>
                <th>Berapa Kilo</th>
                <th>Total bayar</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sellTransaction as $sell)
            <tr class="bg-dark">
            	<td>
            	@if ($sell->transaction->user->avatar ?? '')
				      <img src="{{ Storage::url($sell->transaction->user->avatar ??'') }}" class="img-circle elevation-2" width="80px">
				  @else
				      <img src="https://ui-avatars.com/api/?name={{ $sell->transaction->user->name ?? ''}}" height="60" class="img-circle elevation-2" />
				  @endif
            	</td>
                <td>{{$sell->transaction->user->name ?? ''}}</td>
                <td>{{$sell->laundry->nama_laundry ?? ''}}</td>
                <td>{{$sell->transaction->pilihan_laundry ?? ''}}</td>
                <td>{{$sell->transaction->kilo ?? ''}} Kg</td>
                <td>Rp. {{number_format($sell->total_harga ?? '')}}</td>
                <td>{{$sell->transaction->transaksi_status ?? ''}}</td>
                <td>
                    <a href="#" data-toggle="modal" data-target="#view{{$sell->transaction->id}}" class="btn btn-sm btn-info" target="_blank">
                        <i class="fa fa-eye"></i> 
                    </a>
                    <a href="{{route('cetakPdf',$sell->id)}}" class="btn btn-sm btn-danger" target="_blank">
                        <i class="fa fa-print"></i> 
                    </a>
                    @if($sell->transaction->transaksi_status == 'dijemput')
                        <a href="{{route('transaction-selesai',$sell->transaction->id)}}?status=selesai" class="btn btn-sm btn-success">
                            <i class="fa fa-check"></i> Selesai
                        </a>
                    @endif
                </td>
            </tr>
            {{-- modal pdf --}}
            <div class="modal fade" id="view{{$sell->transaction->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="editLabel">Detail Booking - {{$sell->laundry->nama_laundry}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label>Nama Customer</label>
                                    <input type="text" class="form-control" readonly value="{{$sell->transaction->user->name ?? ''}}">
                                </div>
                                <div class="form-group col-6">
                                    <label>No Customer</label>
                                    <input type="text" class="form-control" readonly value="{{$sell->transaction->user->phone ?? ''}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label>Alamat Jemput</label>
                                    <input type="text" class="form-control" readonly value="{{$sell->transaction->alamat_jemput ?? ''}}">
                                </div>
                                <div class="form-group col-3">
                                    <label>Rt</label>
                                    <input type="text" class="form-control" readonly value="{{$sell->transaction->rt ?? ''}}">
                                </div>
                                <div class="form-group col-3">
                                    <label>Rw</label>
                                    <input type="text" class="form-control" readonly value="{{$sell->transaction->rw ?? ''}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>Keterangan</label>
                                    <textarea readonly class="form-control">{{$sell->transaction->keterangan}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-4">
                                    <label>Nama Laundry</label>
                                    <input type="text" class="form-control" readonly value="{{$sell->laundry->nama_laundry}}">
                                </div>
                                <div class="form-group col-4">
                                    <label>Kilo</label>
                                    <input type="text" class="form-control" readonly value="{{$sell->transaction->kilo}}">
                                </div>
                                <div class="form-group col-4">
                                    <label>Total Bayar</label>
                                    <input type="text" class="form-control" readonly value="{{$sell->total_harga}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <a target="_blank" href="{{route('cetakPdf',$sell->id)}}" class="btn btn-danger btn-sm btn-block">DIJEMPUT / CETAK PDF</a>
                                </div>
                                <div class="col-12">
                                    <button type="button" class="btn btn-secondary btn-sm mt-2 btn-block" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
</div>
@stop

@push('scripts')
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
    </script>
@endpush