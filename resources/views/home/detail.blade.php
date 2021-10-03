@extends('layouts.home')

@section('title')
	Detail
@endsection

@section('content')
	<!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                        <span>Detail</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad page-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-pic-zoom">
                                <img class="product-big-img" src="{{asset('storage/'.$laundry->foto_laundry)}}" alt="" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="product-details">
                                <div class="pd-title">
                                    <span>{{$laundry->alamat_laundry}}</span>
                                    <span style="font-size: 9px;"> Lokasi Penjemputan {{$laundry->lokasi_jemput}}</span>
                                    <h3 class="mt-4">{{$laundry->nama_laundry}}</h3>
                                </div>
                                <div class="pd-desc">
                                    <p>
                                        {{$laundry->deskripsi_laundry}}
                                    </p>
                                    <p style="font-size: 18px;" class=""> Cuci Dan Gosok - <span class="text-white badge badge-primary">Rp.{{number_format($laundry->harga_kilo)}}</span> / Kg</p>
                                    <p style="font-size: 18px;" class=""> Hanya Gosok - <span class="text-white badge badge-primary">Rp.{{number_format($laundry->gosok)}}</span> / Kg</p>
                                </div>
                                <div class="quantity">
                                    @auth
                                        @if(Auth::user()->roles == 3)
                                            <a href="#" data-toggle="modal" data-target="#booking" class="text-center btn btn-sm btn-warning rounded-0 btn-block">Pesan Laundry</a>
                                        @else
                                            <a href="#" class="text-center btn btn-sm btn-warning rounded-0 btn-block" onclick="return confirm('Akun Anda Terdaftar Sebagai Mitra Laundry')">Pesan Laundry</a>
                                        @endif  
                                    @else
                                        <a href="{{route('login')}}" class="text-center btn btn-sm btn-warning rounded-0 btn-block" onclick="return confirm('Opps! sebelum memesan kamu harus login dulu.')">Pesan Laundry</a>
                                    @endauth
                                </div>
                                <div class="" style="margin-top: -10px;">
                                        <a  class="text-center text-white btn btn-sm btn-success rounded-0 btn-block"> <i class="fa fa-phone"></i> {{$laundry->hp_laundry}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->

    <!-- Related Products Section End -->
    <section class="women-banner spad">
        <div class="container-fluid">
            <h4 class="text-muted mb-2">Gallery Laundry</h4>
            <div class="row mb-3">
                @forelse($galleries as $gallery)
                    <div class="col-3">
                        <div class="card-group">
                            <div class="card mt-3" style="border: none;">
                                <img class="card-img-top" src="{{asset('storage/'.$gallery->foto)}}" alt="Card image cap" style="width: 200px; border: 1px solid black; box-shadow: 4px;">
                                <div class="card-body">
                                    <h5 class="card-title mt-2">{{$laundry->nama_laundry}}</h5>
                                    <p class="card-text">
                                        <q class="text-muted"><i>{{$gallery->caption}}</i></q>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                     <div class="row">
                        <div class="col-12">
                            <div class="alert alert-success text-center">
                                Laundry tidak ditemukan.
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
            {{$galleries->links()}}
        </div>
    </section>
    <!-- Related Products Section End -->

    <!-- testi -->
    <section class="women-banner spad mb-4">
    	<div class=" container slideshow-container mb-3">
    		<h4 class="text-muted mb-3">Apa Kata Mereka ?</h4>
		    <div class="mySlides">
		        @forelse($laundry->ulasan as $ulasan)
			        <div class="row">
			            <div class="col-sm-2 col-1 col-lg-1 col-md-1">
			            	@if ($ulasan->user->avatar ?? '')
			                    <img src="{{ Storage::url($$ulasan->user->avatar ?? '') }}" class="rounded-circle" style="width: 60px;">
			                @else
			                    <img src="https://ui-avatars.com/api/?name={{ $ulasan->user->name ?? '' }}" class="rounded-circle" style="width: 60px;">
			                @endif
			            </div>
			            <div class="col-5">
			                <q>{{$ulasan->ulasan ?? ''}}</q>
			                <p class="author">- {{$ulasan->user->name ?? ''}}</p>
			            </div>
			        </div>
		        @empty
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-success text-center">
                                Belum ada ulasan.
                            </div>
                        </div>
                    </div>
                @endforelse
		    </div>
		</div>
    </section>

{{-- modal booking --}}
<div class="modal fade" id="booking" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="editLabel">Booking laundry - {{$laundry->nama_laundry}}</h5> <br>
        <div style="font-size: 14px;"></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form action="{{route('booking')}}" method="post">
        @csrf 
        <input type="hidden" name="harga_perkilo" value="{{$laundry->harga_kilo}}">
        <input type="hidden" name="harga_gosok" value="{{$laundry->gosok}}">
        <input type="hidden" name="laundry_id" value="{{$laundry->id}}" class="form-control " readonly>
            <div class="modal-body">
              <div class="row">
                <div class="form-group col-12">
                  <label for="name">Nama Pemesan</label>
                  @auth
                    <input type="text" readonly value="{{Auth::user()->name}}" class="form-control">
                  @endauth
                </div>
                <div class="form-group col-12">
                  <label for="alamat_jemput">Alamat jemput</label>
                  <input type="text" name="alamat_jemput" class="form-control @error('alamat_jemput') is-invalid @enderror">
                   @error('alamat_jemput')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-6">
                  <label for="rt">Rt</label>
                  <input type="number" name="rt" id="rt" class="form-control @error('rt') is-invalid @enderror">
                   @error('rt')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-6">
                  <label for="rw">Rw</label>
                  <input type="number" name="rw" id="rw" class="form-control @error('rw') is-invalid @enderror">
                   @error('rw')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
               <!--  <div class="row">
                    <div class="col-12">
                        <div class="form-group col-6">
                            
                        </div>
                        <div class="form-group col-6">
                            
                        </div>
                    </div>
                </div> -->
                <div class="row col-12">
                    <div class="col-6">
                        <div class="form-check">
                          <input name="hanya_gosok" class="form-check-input" type="checkbox" value="{{$laundry->gosok}}">
                          <label class="form-check-label" for="defaultCheck1">
                            Hanya Gosok  Rp. {{number_format($laundry->gosok)}} / Kilo
                          </label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-check">
                          <input name="" class="form-check-input" type="checkbox" value="">
                          <label class="form-check-label" for="defaultCheck1">
                            Cuci Dan Gosok  Rp. {{number_format($laundry->harga_kilo)}} / Kilo
                          </label>
                        </div>
                    </div>
                </div>
                <div class="form-group col-12 mt-3">
                  <label for="kilo">Berapa kilo</label>
                  <input type="number" name="kilo" class="form-control @error('kilo') is-invalid @enderror ">
                   @error('kilo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                    
                <hr>
                <div class="form-group col-12">
                  <label for="keterangan">Keterangan / Detail Penjemputan</label> <br>
                  <div class="text-muted" style="font-size: 13px;">{{$laundry->nama_laundry}} Hanya Menerima Jemputan Pada Wilayah {{$laundry->lokasi_jemput}}</div>
                  <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan"></textarea>
                   @error('keterangan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Booking</button>
            </div>
        </form>
    </div>
    </div>
</div>
@endsection