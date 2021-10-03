@extends('layouts.app')

@section('title')
    Riwayat laundry saya
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
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item">Riwayat laundry saya</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
@if(session('status'))
  <div class="alert alert-success">
      {{session('status')}}
  </div>
@endif
{{-- info --}}
<div class="alert alert-warning alert-dismissible fade show" role="alert" style="width: 40%;">
  Selamat datang<strong> {{Auth::user()->name}}</strong> <br>
  <ul>
    <li>Jika anda sudah menerima pakaian laundry anda silahkan klik tombol diterima</li>
    <li>Ketika anda sudah menekan tombol terima anda dapat melakukan booking kembali</li>
    <li>Dan berikan ulasan Pada laundry.</li>
  </ul>
  <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
  <div class="card">
    <!-- /.card-header -->
    <div class="card-body">
      <table id="table_id" class="table table-striped">
        <thead>
            <tr>
                <th>Foto laundry</th>
                <th>Nama laundry</th>
                <th>Berapa kilo</th>
                <th>Status Booking</th>
                <th>Total harga</th>
                <th></th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($buyTransaction as $buy)
            <tr class="bg-dark">
                <td>
                @if ($buy->laundry->foto_laundry)
                      <img src="{{ Storage::url($buy->laundry->foto_laundry) }}" class=" elevation-2" style="width: 60px;">
                  @else
                      <img src="https://ui-avatars.com/api/?name={{ $buy->laundry->nama_laundry }}" height="60" class="img-circle elevation-2" />
                  @endif
                </td>
                <td>
                    {{$buy->laundry->nama_laundry}} <br>
                    <small class="text-muted">{{$buy->laundry->harga_kilo}} / Kg</small>
                </td>
                <td>{{$buy->transaction->kilo}} Kg</td>
                <td>{{$buy->transaction->transaksi_status}}</td>
                <td>Rp. {{number_format($buy->total_harga)}}</td>
                <td>
                    {{\Carbon\Carbon::createFromTimeStamp(strtotime($buy->created_at))->diffForHumans()}}
                </td>
                <td>
                  {{-- jika transaksi status selesai atau diterima, bisa lakukan booking --}}
                    @if( $buy->transaction->transaksi_status == 'diterima')
                      <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#booking{{$buy->laundry->id}}">
                        <i class="fa fa-order"></i> Booking
                      </a>
                    @else
                      <span class="text-warning">{{$buy->transaction->transaksi_status}}</span> &nbsp;
                    @endif

                    {{-- jika transaksi status atau diterima, bisa hapus transaksi --}}
                    {{-- @if( $buy->transaction->transaksi_status == 'diterima')
                      <a class="btn btn-sm btn-danger" href="{{route('transaction.remove',$buy->id)}}" onclick="return confirm('Apakah anda yakin ingin menghapus {{$buy->laundry->nama_laundry}} dari riwayat laundry anda ? ')">
                       Deleted
                      </a>
                    @endif --}}

                    {{-- jika transaksi status selesai. bisa update transaksi status diterima--}}
                    @if($buy->transaction->transaksi_status == 'selesai')
                      <a href="{{url('transaction-diterima/' .$buy->transaction_id. '/' .$buy->laundry_id)}}" class="btn btn-sm btn-info">
                        <i class="fa fa-order"></i> Diterima
                      </a>
                    @endif
                </td>
            </tr>
            {{-- modal booking --}}
            <div class="modal fade" id="booking{{$buy->laundry->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="editLabel">Booking laundry - {{$buy->laundry->nama_laundry}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form action="{{route('booking')}}" method="post">
                    @csrf 
                    <input type="hidden" name="laundry_id" value="{{$buy->laundry->id}}">
                    <input type="hidden" name="harga_perkilo" value="{{$buy->laundry->harga_kilo}}">
                        <div class="modal-body">
                          <div class="row">
                            <div class="form-group col-12">
                              <label for="name">Nama Pemesan</label>
                              <input type="text" value="{{Auth::user()->name}}" class="form-control " readonly>
                            </div>
                            <div class="form-group col-12">
                              <label for="alamat_jemput">Alamat jemput</label>
                              <input type="text" name="alamat_jemput" class="form-control @error('alamat_jemput') is-invalid @enderror">
                            </div>
                            <div class="form-group col-6">
                              <label for="rt">Rt</label>
                              <input type="number" name="rt" id="rt" class="form-control @error('rt') is-invalid @enderror">
                            </div>
                            <div class="form-group col-6">
                              <label for="rw">Rw</label>
                              <input type="number" name="rw" id="rw" class="form-control @error('rw') is-invalid @enderror">
                            </div>
                            <div class="form-group col-12">
                              <label for="kilo">Berapa kilo</label>
                              <input type="number" name="kilo" class="form-control @error('kilo') is-invalid @enderror ">
                            </div>
                            <div class="form-group col-12">
                              <label for="keterangan">Keterangan / Detail Penjemputan</label>
                              <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan"></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Booking</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
            @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
</div>

@endsection

@push('scripts')
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
    </script>
@endpush
