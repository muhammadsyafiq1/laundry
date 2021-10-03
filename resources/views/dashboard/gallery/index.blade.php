@extends('layouts.app')

@section('title')
    Gallery laundry
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
          <li class="breadcrumb-item">Gallery laundry</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="row mb-2">
  <div class="col-12">
    <button class="btn btn-sm btn-success"  data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-plus"> Tambah Gallery</i>
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
          <th>Laundry</th>
          <th>Caption</th>
          <th>Gambar</th>
          <th>actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($galleries as $gallery)
              <tr class="bg-dark">
                <td>{{$gallery->laundry->nama_laundry}}</td>
                <td>{{$gallery->caption}}</td>
                <td>
                  <img src="{{asset('storage/'.$gallery->foto)}}" style="width: 80px;">
                </td>
                <td>
                  <form action="{{route('gallery.destroy',$gallery->id)}}" method="post" enctype="multipart/form-data">
                    @csrf @method('delete')
                    <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit{{$gallery->id}}">
                      <i class="fa fa-edit"></i> Edit
                    </a>
                    <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Apakah anda ingin menghapus gallery .{{$gallery->laundry->nama_laundry}}. ?')">
                      <i class="fa fa-trash"></i> Delete
                    </button>
                  </form>
                </td>
              </tr>
              {{-- modal edit --}}
            <div class="modal fade" id="edit{{$gallery->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="editLabel">Edit gallery</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form action="{{route('gallery.update',$gallery->id)}}" method="post" enctype="multipart/form-data">
                    @csrf @method('put')
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="laundry_id">Nama laundry</label>
                                     <select name="laundry_id" class="form-control @error('laundry_id') is-invalid @enderror ">
                                      @foreach($laundries as $laundry)
                                        <option value="{{$laundry->id}}" {{$laundry->id == $gallery->laundry_id ? 'selected' : ''}}>
                                          {{$laundry->nama_laundry}}
                                        </option>
                                      @endforeach
                                    </select>
                                    @error('laundry_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-12">
                                <label for="caption">Caption</label>
                                <input type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{old('caption') ? old('caption') : $gallery->caption}}">
                                 @error('caption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-12">
                                <img src="{{asset('storage/'.$gallery->foto)}}" style="width: 100px"> <br>
                                <label for="foto">foto</label>
                                <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto">
                                <small class="text-danger">Kosongkan bila tidak ingin diubah.</small>
                                @error('foto')
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
        <form action="{{route('gallery.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
              <div class="form-group">
                <label>Laundry</label>
                <select name="laundry_id" class="form-control @error('laundry_id') is-invalid @enderror ">
                  <option selected disabled value="0">--Pilih Laundry--</option>
                  @foreach($laundries as $laundry)
                    <option value="{{$laundry->id}}">
                      {{$laundry->nama_laundry}}
                    </option>
                  @endforeach
                </select>
                @error('laundry_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group">
                <label>Gambar</label>
                <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
                @error('foto')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group">
                <label>Caption</label>
                <input type="text" name="caption" class="form-control @error('caption') is-invalid @enderror">
                @error('caption')
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