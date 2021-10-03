@extends('layouts.app')

@section('title')
    Dashbaord
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
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')

<div class="container-fluid">
    <!-- Info boxes -->
    {{-- admin --}}
    @if(Auth::user()->roles == 1 || Auth::user()->roles == 3)
    <div class="row">
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-6">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Total Pengguna</span>
            <span class="info-box-number">{{$totalPengguna}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-6">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-tshirt"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Laundry aktif</span>
            <span class="info-box-number">{{$totalLaundry}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    @endif
    {{-- pencari --}}
    @if(Auth::user()->roles == 2)
    <div class="row">
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-6">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Total laundry dibooking</span>
            <span class="info-box-number">{{$sellTransaction->count() }} 
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-6">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-tshirt"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Laundry saya</span>
            <span class="info-box-number">{{$totalLaundryKu}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    @endif


</div><!--/. container-fluid -->
@endsection
