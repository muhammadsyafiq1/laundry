@extends('layouts.app')

@section('title')
	Rekening
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
          <li class="breadcrumb-item">Rekening</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@stop

@section('content')
<div class="row mb-2">
	<div class="col-12">
		<button class="btn btn-sm btn-success"  data-toggle="modal" data-target="#exampleModal">
	  		<i class="fa fa-plus"> Tambah Rekening</i>
	  	</button>
	</div>
</div>
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
          <th>Nama bank</th>
          <th>No. rek</th>
          <th>Atas Nama</th>
          <th>actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($reks as $rek)
              <tr class="bg-dark">
                  <td>{{$rek->nama_bank}}</td>
                  <td>{{$rek->no_rek}}</td>
                  <td>{{$rek->atas_nama}}</td>
                  <td>
                      	<form action="{{route('rekening.destroy',$rek->id)}}" method="post" class="d-inline">
	                        @csrf @method('delete')
	                        <a href="#" data-toggle="modal" data-target="#edit{{$rek->id}}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
	                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Ingin Menghapus rekening .{{$rek->no_rek}}.?')">
	                          <i class="fa fa-trash"> Hapus</i>
	                        </button>
                      	</form>
                  </td>
              </tr>
              {{-- modal --}}
            <div class="modal fade" id="edit{{$rek->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="editLabel">Form Edit Fitur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form action="{{route('rekening.update',$rek->id)}}" method="post">
                    @csrf @method('put')
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="nama_bank">Nama Bank</label>
                                    <input value="{{old('nama_bank') ? old('nama_bank') : $rek->nama_bank}}" name="nama_bank" type="text" class="form-control @error('nama_bank') is-invalid @enderror" id="nama_bank">
                                    @error('nama_bank')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="no_rek">No rekening</label>
                                    <input value="{{old('no_rek') ? old('no_rek') : $rek->no_rek}}" name="no_rek" type="number" class="form-control @error('no_rek') is-invalid @enderror" id="no_rek">
                                    @error('no_rek')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="atas_nama">Atas Nama</label>
                                    <input value="{{old('atas_nama') ? old('atas_nama') : $rek->atas_nama}}" name="atas_nama" type="text" class="form-control @error('atas_nama') is-invalid @enderror" id="atas_nama">
                                    @error('atas_nama')
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
          @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>

{{-- modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Form Tambah Rekening</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('rekening.store')}}" method="post" enctype="multipart/form-data">
            @csrf
           	<div class="modal-body">
           		<div class="form-group">
           			<label>Nama Bank</label>
           			<input type="text" name="nama_bank" class="form-control @error('nama_bank') is-invalid @enderror">
           			@error('nama_bank')
		                <span class="invalid-feedback" role="alert">
		                    <strong>{{ $message }}</strong>
		                </span>
		            @enderror
           		</div>
           		<div class="form-group">
           			<label>No rek</label>
           			<input type="number" name="no_rek" class="form-control @error('no_rek') is-invalid @enderror">
           			@error('no_rek')
		                <span class="invalid-feedback" role="alert">
		                    <strong>{{ $message }}</strong>
		                </span>
		            @enderror
           		</div>
           		<div class="form-group">
           			<label>Atas nama</label>
           			<input type="text" name="atas_nama" class="form-control @error('atas_nama') is-invalid @enderror">
           			@error('atas_nama')
		                <span class="invalid-feedback" role="alert">
		                    <strong>{{ $message }}</strong>
		                </span>
		            @enderror
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

@push('scripts')
    <script>
      $(document).ready(function(){
        $('#tb_user').DataTable();
      });
    </script>
@endpush