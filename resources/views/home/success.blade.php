@extends('layouts.home')

@section('title')
	Success
@endsection

@section('content')
<div class="d-flex success-checkout align-items-center justify-content-center">
        <div class="col col-lg-4 text-center">
            <img src="{{asset('frontend/img/success-buy.png')}}" alt="" width="294">
            <h3 class="mt-4">
                Sukses Booking!
            </h3>
            <p class="mt-2">
                Terimakasih sudah berlangganan pada laundry kami. silahkan cek dashboard anda untuk cek informasi laundry anda
            </p>
            <a href="{{url('/')}}" class="primary-btn pd-cart mt-3">Back to Home</a>
        </div>
    </div>
@endsection()