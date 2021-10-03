@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-md-9">
          @if (session('status'))
          <div class="alert alert-success">
                    {{session('status')}}
                </div>
        @endif
        <div class="card card-primary card-outline">
            <form action="{{route('user.update',$user->id)}}" method="post" enctype="multipart/form-data">
                @csrf @method('put')
                <div class="card-body box-profile">
                    <div class="text-center">
                        @if ($user->avatar)
                            <img src="{{ Storage::url($user->avatar) }}" class="profile-user-img img-fluid img-circle">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ $user->name }}" height="60" class="profile-user-img img-fluid img-circle"/>
                        @endif
                    </div>
                    <input type="file" class="@error('avatar') is-invalid @enderror text-center" name="avatar"> <br>
                    <i class="text-danger" style="font-size: 12px;">Kosongkan bila tidak ingin merubah gambar.</i>
                  </div>
                  <!-- /.card-body -->
                </div>
              <div class="card">
                <div class="card-body">
                    <div class="row">
                          <div class="form-group col-12">
                                  <label for="name">Nama</label>
                                  <input value="{{old('name') ? old('name') : $user->name}}" type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                                  @error('name')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                          </div>
                          <div class="form-group col-12">
                              <label for="email">Email</label>
                              <input readonly value="{{old('email') ? old('email') : $user->email}}" type="text" name="email" class="form-control @error('email') is-invalid @enderror">
                              @error('email')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                          <div class="form-group col-12">
                              <label for="phone">Phone</label>
                              <input value="{{old('phone') ? old('phone') : $user->phone}}" type="text" name="phone" class="form-control @error('phone') is-invalid @enderror">
                              @error('phone')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                          <div class="form-group col-12">
                              <label for="alamat">Alamat</label>
                              <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control @error('alamat') is-invalid @enderror">{{old('alamat') ? old('alamat') : $user->alamat}}</textarea>
                              @error('alamat')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                    </div>
                    <button class="btn-block btn-success" type="submit">
                        Simpan
                    </button>
                </div>
              </div>
              <!-- /.card -->
            </form>
      </div>
      <!-- /.col -->
    </div>

    <div class="row">
        <div class="col-md-9">
          <div class="card card-primary card-outline">
              <form action="{{route('ganti-password')}}" method="post">
                  @csrf
                    <!-- /.card-body -->
                  </div>
                <div class="card">
                  <div class="card-body">
                      <div class="row">
                            <div class="form-group col-12">
                                <label for="password">Password Baru</label>
                                <input  type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukan Password" autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-12">
                                <label for="password">Ulangi Password Baru</label>
                                <input placeholder="Konfirmasi Password" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                      </div>
                      <button class="btn-block btn-success" type="submit">
                          Simpan  
                      </button>
                  </div>
                </div>
                <!-- /.card -->
              </form>
        </div>
        <!-- /.col -->
      </div>
</div>
@endsection