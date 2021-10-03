@extends('layouts.app')

@section('title')
    Data Pengguna
@endsection

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Laundry</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Data Laundry</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="card">
  @if (session('status'))
      <div class="alert alert-primary">
          {{session('status')}}
      </div>
  @endif
  <div class="card-body">
    <table id="tb_user" class="table table-striped">
      <thead>
        <tr>
          <th>ID Laundry</th>
          <th>Pemilik laundry</th>
          <th>Nomor Pemilik</th>
          <th>Nama laundry</th>
          <th>Gambar laundry</th>
          <th>actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($laundries as $laundry)
          <tr class="bg-dark">
              <td>{{$laundry->id}}</td>
              <td>{{$laundry->user->name}}</td>
              <td>{{$laundry->user->phone}}</td>
              <td class="text-success">{{$laundry->nama_laundry}}</td>
              <td>
                <img src="{{Storage::url($laundry->foto_laundry)}}" style="width: 100px;">
              </td>
              <td>
              
                @if($laundry->status_laundry == 'diproses')
                  <a href="{{route('laundry-aktif',$laundry->id)}}?status=aktifkan" class="btn btn-success btn-sm"> Aktifkan
                </a>
                @else
                  <i class="fa fa-check text-success"> Aktif</i>
                @endif
              </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
@endsection

@push('scripts')
    <script>
      $(document).ready(function(){
        $('#tb_user').DataTable();
      });
    </script>
@endpush