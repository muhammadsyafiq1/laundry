@extends('layouts.app')

@section('title')
    Fitur Kurir
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif
<div class="card">
    <div class="card-header float-right">
        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-plus"></i>
             Fitur
        </button>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="table_id" class="table table-striped">
        <thead>
            <tr>
                <th>Nama Fitur</th>
                <th>Keterangan</th>
                <th>Biaya tambahan</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kurirs as $item)
            <tr class="bg-dark">
                <td>{{$item->nama_fitur}}</td>
                <td>{{$item->keterangan}}</td>
                <td>Rp. {{number_format($item->biaya_tambahan)}}</td>
                <td>
                    <form action="{{route('fitur-kurir.destroy',$item->id)}}" method="post" class="d-inline">
                        @csrf @method('delete')
                        <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit{{$item->id}}">
                            <i class="fa fa-edit"></i>
                        </a>
                        <button class="btn btn-sm btn-danger" type="submit">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            {{-- modal edit --}}
            <div class="modal fade" id="edit{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="editLabel">Form Edit Fitur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form action="{{route('fitur-kurir.update',$item->id)}}" method="post">
                    @csrf @method('put')
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="nama_fitur">Nama Fitur</label>
                                    <input value="{{old('nama_fitur') ? old('nama_fitur') : $item->nama_fitur}}" name="nama_fitur" type="text" class="form-control @error('nama_fitur') is-invalid @enderror" id="nama_fitur">
                                    @error('nama_fitur')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="keterangan">Keterangan</label>
                                    <input value="{{old('keterangan') ? old('keterangan') : $item->keterangan}}" name="keterangan" type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan">
                                    @error('keterangan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="biaya_tambahan">Biaya dikenakan</label>
                                    <input value="{{old('biaya_tambahan') ? old('biaya_tambahan') : $item->biaya_tambahan}}" name="biaya_tambahan" type="number" class="form-control @error('biaya_tambahan') is-invalid @enderror" id="biaya_tambahan">
                                    @error('biaya_tambahan')
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
          <h5 class="modal-title" id="exampleModalLabel">Form Tambah Fitur</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('fitur-kurir.store')}}" method="post">
        @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-12">
                        <label for="nama_fitur">Nama Fitur</label>
                        <input name="nama_fitur" type="text" class="form-control @error('nama_fitur') is-invalid @enderror" id="nama_fitur">
                        @error('nama_fitur')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="keterangan">Keterangan</label>
                        <input name="keterangan" type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan">
                        @error('keterangan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="biaya_tambahan">Biaya dikenakan</label>
                        <input name="biaya_tambahan" type="text" class="form-control @error('biaya_tambahan') is-invalid @enderror" id="biaya_tambahan">
                        @error('biaya_tambahan')
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

@push('scripts')
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
    </script>
@endpush