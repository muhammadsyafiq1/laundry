@extends('layouts.auth')

@section('content')
<div class="register-box">
    <div class="register-logo">
    <b class="text-warning" style="font-weight: bold;">Laundry'in <span class="text-primary">Aja</span> </b>
    </div>
  
    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">Register a new membership</p>
  
        <form action="{{route('register')}}" method="post">
            @csrf
          <div class="input-group mb-3">
            <input placeholder="Masukan Nama" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="input-group mb-3">
            <input placeholder="Masukan Email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
            <div class="input-group mb-3">
            <input placeholder="Masukan No Handphone" id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-phone"></span>
              </div>
            </div>
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
            <div class="input-group mb-3">
            <input placeholder="Masukan Alamat" id="alamat" type="alamat" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" required autocomplete="alamat">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-street-view"></span>
              </div>
            </div>
            @error('alamat')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="input-group mb-3">
            <select name="roles" id="roles" class="form-control @error('roles') is-invalid @enderror">
                <option value="0" selected disabled class="text-muted">Daftar Sebagai--</option>
                <option value="2">Pemilik Laundry</option>
                <option value="3">Customer</option>
            </select>
          </div>
          <div class="input-group mb-3">
            <input placeholder="Masukan Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="input-group mb-3">
            <input placeholder="Konfirmasi Password" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
  
        <a href="{{route('login')}}" class="text-center">I already have a membership</a>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
</div>
@endsection


