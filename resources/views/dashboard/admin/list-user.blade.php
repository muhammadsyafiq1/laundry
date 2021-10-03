@extends('layouts.app')

@section('title')
    Data Pengguna
@endsection

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Pengguna</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Data Pengguna</li>
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
          <th>Avatar</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Roles</th>
          <th>Bergabung</th>
          <th>actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
              <tr class="bg-dark">
                  <td>
                    @if ($user->avatar)
                        <img src="{{ Storage::url($user->avatar) }}" height="60px;">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ $user->name }}" height="60" class="rounded-circle" />
                    @endif
                  </td>
                  <td>{{$user->name}}</td>
                  <td class="text-success">{{$user->email}}</td>
                  <td>
                      @if ($user->roles == 1)
                        <span class="text-primary">Admin</span>
                      @elseif($user->roles == 2)
                        <span class="text-warning">Mitra</span>
                      @else
                        <span>Customer</span>
                      @endif
                  </td>
                  <td>{{date('d/m/Y',strtotime($user->created_at))}}</td>
                  <td>
                      <form action="{{route('user.destroy',$user->id)}}" method="post" class="d-inline">
                        @csrf @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Ingin Menghapus User?')">
                          <i class="fa fa-trash"> Hapus</i>
                        </button>
                      </form>
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