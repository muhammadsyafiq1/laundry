@extends('layouts.home')

@section('title')
	Home
@endsection

@section('content')
<!-- Header Section Begin -->
    @include('includes.frontend.header')
    <!-- Header End -->

    <!-- Hero Section Begin -->
    <section class="hero-section">
        <div class="hero-items owl-carousel">
            @foreach($banners as $banner)
            <div class="single-hero-items set-bg" data-setbg="{{asset('storage/'.$banner->banner)}}" style="height: 500px; ">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <h2 class="text-warning" style="font-weight: bold;">{{$banner->title}}</h2>
                            <p class="text-white" style="font-weight: bold;">
                                {{$banner->sub_title}}
                            </p>
                            <a href="#laundry" class="primary-btn">Lihat laundry</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- search -->
    <section class="search mt-5">
        <div class="container">
            <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="container-1">
                        <span class="icon"><i class="fa fa-search"></i></span>
                        <form  action="{{route('home.laundry')}}">
                            <input type="search" name="keyword" id="search" placeholder="Cari berdasarkan nama laundry ...">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

<!-- laundry terbaru -->
<section class="women-banner spad" id="laundry">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 mt-5 mb-2">
                <h4 class="text-muted mb-3">Pilihan Laundry Terbaru</h4>
            </div>
        </div>
        <div class="row">
            @forelse($laundries as $laundry)
            <div class="col-lg-4 col-sm-6">
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="{{asset('storage/'.$laundry->foto_laundry)}}" alt="" style="height: 400px;">
                            <ul>
                                <li class="w-icon active">
                                    <a href="#"><i class="icon_bag_alt"></i></a>
                                </li>
                                <li class="quick-view"><a href="{{route('detail',$laundry->slug_laundry)}}">+ Quick View</a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">{{$laundry->alamat_laundry}}</div>
                            <a href="#">
                                <h5>{{$laundry->nama_laundry}}</h5>
                            </a>
                            <div class="product-price">
                                Rp. {{number_format($laundry->harga_kilo)}} / Kilo
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="alert alert-success">Laundry Tidak Ditemukan, <a href="{{url('/')}}">Lihat Semua</a> </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>
    <!-- laundry terbaru End -->
@endsection