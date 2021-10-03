@extends('layouts.app')

@section('title')
    Banner
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
          <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
          <li class="breadcrumb-item">Banner</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif

<div class="row mb-2">
  <div class="col-12">
    <button class="btn btn-sm btn-success"  data-toggle="modal" data-target="#tambah">
        <i class="fa fa-plus"> Tambah Banner</i>
      </button>
  </div>
</div>

<div class="card">
    <!-- /.card-header -->
    <div class="card-body">
      <table id="table_id" class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Subtitle</th>
                <th>Banner</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($banners as $item)
            <tr class="bg-dark">
                <td>{{$item->title}}</td>
                <td>{{$item->sub_title}}</td>
                <td>
                    <img src="{{asset('storage/'.$item->banner)}}"  style="width: 200px;">
                </td>
                <td>
                    <form action="{{route('banner.destroy',$item->id)}}" method="post" class="d-inline">
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
                    <h5 class="modal-title" id="editLabel">Edit Banner - {{$item->id}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form action="{{route('banner.update',$item->id)}}" method="post" enctype="multipart/form-data">
                    @csrf @method('put')
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="title">Title</label>
                                    <textarea name="title" class="form-control @error('title') is-invalid @enderror" id="title">{{old('title') ? old('title') : $item->title}}</textarea>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label for="sub_title">Subtitle</label>
                                    <textarea name="sub_title" class="form-control @error('sub_title') is-invalid @enderror" id="sub_title">{{old('sub_title') ? old('sub_title') : $item->sub_title}}</textarea>
                                    @error('sub_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label for="banner">Banner</label>
                                    <input type="file" name="banner" class="form-control @error('banner') is-invalid @enderror">
                                    <i class="text-danger">Kosongkan bila tidak ingin merubah banner</i>
                                    @error('banner')
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


{{-- modal edit --}}
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="editLabel">Tambah Banner</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form action="{{route('banner.store')}}" method="post" enctype="multipart/form-data">
        @csrf 
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-12">
                        <label for="title">Title</label>
                        <textarea name="title" class="form-control @error('title') is-invalid @enderror" id="title"></textarea>
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-12">
                        <label for="sub_title">Subtitle</label>
                        <textarea name="sub_title" class="form-control @error('sub_title') is-invalid @enderror" id="sub_title"></textarea>
                        @error('sub_title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-12">
                        <label for="banner">Banner</label>
                        <input type="file" name="banner" class="form-control @error('banner') is-invalid @enderror">
                        @error('banner')
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