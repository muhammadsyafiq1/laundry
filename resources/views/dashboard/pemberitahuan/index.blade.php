@extends('layouts.app')

@section('title')
	Pemberitahuan
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
          <li class="breadcrumb-item"><a href="{{route('laundry.index')}}">Laundry</a></li>
          <li class="breadcrumb-item">Pemberitahuan</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@stop

@section('content')
<div class="card">
    <!-- /.card-header -->
    <div class="card-body">
      <table id="table_id" class="table table-striped">
        <thead>
            <tr>
                <th>Nama laundry</th>
                <th>Keterangan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pemberitahuan as $item)
            <tr class="bg-dark">
                <td>{{$item->laundry->nama_laundry}}</td>
                <td>{{$item->info}}</td>
                <td>
                  @if($item->status == 'belum dibaca')
                    <a class="btn btn-success btn-sm" href="{{route('pemberitahuan.dibaca',$item->id)}}?status=dibaca">
                      Baca
                    </a>
                  @endif
                  <a href="{{route('pemberitahuan.remove',$item->id)}}" class="btn btn-sm btn-trash btn-danger" onclick="return confirm('Apakah anda ingin menghapus pemberitahuan?')">
                    Delete
                  </a>
                </td>
            </tr>
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