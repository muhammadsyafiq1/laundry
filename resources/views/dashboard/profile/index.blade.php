@extends('layouts.app')

@section('title')
    Profile
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-md-6">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
                @if ($user->avatar)
                    <img src="{{ Storage::url($user->avatar) }}" class="profile-user-img img-fluid img-circle">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ $user->name }}" height="60" class="profile-user-img img-fluid img-circle"/>
                @endif
            </div>

            <h3 class="profile-username text-center">{{$user->name}}</h3>

            @if ($user->roles == 1)
                <p class="text-muted text-center">
                    Admin
                </p>
            @elseif($user->roles == 2)
                <p class="text-muted text-center">
                    Tukang
                </p>
            @else
                <p class="text-muted text-center">
                    Customer
                </p>
            @endif

            <p class="text-muted text-center">

            </p>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Email</b> <a class="float-right">{{$user->email}}</a>
              </li>
              <li class="list-group-item">
                <b>Bergabung</b> <a class="float-right">{{date('d/m/Y',strtotime($user->created_at))}}</a>
              </li>
              <li class="list-group-item">
                <b>Phone</b> <a class="float-right">{{$user->phone}}</a>
              </li>
              <li class="list-group-item">
                <b>Address</b> <a class="float-right">{{$user->address}}</a>
              </li>
            </ul>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
@endsection