@extends('layouts.app')

@section('title')
    Transfer
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
          <li class="breadcrumb-item"><a href="{{route('laundry.index')}}">Home</a></li>
          <li class="breadcrumb-item">Bukti transer</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@stop

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif
{{-- roles 2 --}}
@if(Auth::user()->roles == '2')
    <div class="card">
    <!-- /.card-header -->
    <div class="card-body">
      <table id="table_id" class="table table-striped">
        <thead>
            <tr>
                <th>Pengirim</th>
                <th>Laundry</th>
                <th>Sewa</th>
                <th>Rekening tujuan</th>
                <th>Bukti bayar</th>
                <th>Code transfer</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transfers as $transfer)
            <tr class="bg-dark">
                <td>{{$transfer->laundry->user->name}}</td>
                <td>{{$transfer->laundry->nama_laundry}}</td>
                <td>{{$transfer->sewa_selama}}</td>
                <td>{{$transfer->rekening->nama_bank}} / {{$transfer->rekening->atas_nama}}</td>
                <td>
                    <a href="{{asset('storage/'.$transfer->bukti_bayar)}}">
                        Lihat bukti
                    </a>
                </td>
                <td>{{$transfer->code_transfer}}</td>
                <td>{{$transfer->status_bukti_pembayaran}}</td>
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
</div>
@endif

{{-- admin --}}
@if(Auth::user()->roles == '1')
    <div class="card">
    <!-- /.card-header -->
    <div class="card-body">
      <table id="table_id" class="table table-striped">
        <thead>
            <tr>
                <th>Pengirim</th>
                <th>Laundry</th>
                <th>Sewa</th>
                <th>Rekening tujuan</th>
                <th>Bukti bayar</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transferall as $transfer)
            <tr class="bg-dark">
                <td>{{$transfer->laundry->user->name}}</td>
                <td>{{$transfer->laundry->nama_laundry}}</td>
                <td>{{$transfer->sewa_selama}}</td>
                <td>{{$transfer->rekening->nama_bank}} / {{$transfer->rekening->atas_nama}}</td>
                <td class="text-success">{{$transfer->status_bukti_pembayaran}}</td>
                <td>
                    <a href="{{asset('storage/'.$transfer->bukti_bayar)}}">
                        Lihat bukti
                    </a>
                </td>
                <td>
                    @if($transfer->status_bukti_pembayaran != 'berhasil')
                        <a data-toggle="modal" data-target="#gagal{{$transfer->id}}" href="#" class="btn btn-sm btn-danger">
                            <i class="fa fa-times"> Decline</i>
                        </a>
                         <a href="{{route('pemberitahuan.accept',$transfer->id)}}?info=berhasil" class="btn btn-sm btn-success">
                            <i class="fa fa-check">Accept</i>
                        </a>
                    @endif
                </td>
            </tr>
            {{-- modal edit --}}
            <div class="modal fade" id="gagal{{$transfer->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="editLabel">Bukti bayar gagal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form action="{{route('pemberitahuan.decline',$transfer->id)}}" method="post">
                    @csrf 
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="info">Keterangan</label>
                                    <textarea name="info" class="form-control" required></textarea>
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
            @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
</div>
@endif
@endsection

@push('scripts')
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
    </script>
@endpush