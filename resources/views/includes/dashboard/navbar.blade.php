<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      @php
        $laundryBaru = App\Models\Laundry::where('status_laundry','=','diproses')->orWhere('status_laundry','=','dibayar')->get();
        $pemberitahuan = App\Models\Pemberitahuan::with('laundry')->where('status','=','belum dibaca')->get();
      @endphp
      {{-- admin --}}
      @if(Auth::user()->roles == '1')
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">{{$laundryBaru->count()}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-2">
          <div class="dropdown-divider"></div>
          {{-- <a href="#" class="dropdown-item"> --}}
            <i class="fas fa-envelope mr-2"></i> {{$laundryBaru->count()}} Mendaftar <br>
            @foreach($laundryBaru as $laundry)
              <span>{{$laundry->nama_laundry}}</span> <br></small> 
              <span class="float-right text-muted text-sm">
                {{\Carbon\Carbon::createFromTimeStamp(strtotime($laundry->created_at))->diffForHumans()}}
              </span> <br>
            @endforeach
          {{-- </a> --}}
          <div class="dropdown-divider"></div>
          <a href="{{route('laundry-all')}}" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      @endif
      {{-- pemilik --}}
      <!-- @if(Auth::user()->roles == '2')
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">{{$pemberitahuan->count()}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-2">
          <div class="dropdown-divider"></div>
          {{-- <a href="#" class="dropdown-item"> --}}
            {{-- notifikasi pemberitahuan dari admin --}}
            <i class="fas fa-envelope mr-2"></i> {{$pemberitahuan->count()}} Pemberitahuan <br>
            @foreach($pemberitahuan as $pemberitahuan)
              <span>{{$pemberitahuan->laundry->nama_laundry}}</span> <br>
              <small>({{$pemberitahuan->info}})</small> 
              <span class="float-right text-muted text-sm">
                {{\Carbon\Carbon::createFromTimeStamp(strtotime($pemberitahuan->created_at))->diffForHumans()}}
              </span> <br>
            @endforeach
          {{-- </a> --}}
          <div class="dropdown-divider"></div>
          <a href="{{route('pemberitahuan.index')}}" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      @endif -->

      {{-- customer --}}
      @if(Auth::user()->roles == '3')
       @php  
          $TransaksiSelesai = App\Models\Transaction_detail::with(['transaction.user','laundry.gallery'])->whereHas('transaction', function($transaction){
                    $transaction->where('transaksi_status','=','selesai')->where('user_id',Auth::user()->id);
            })->get();;
        @endphp
      <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">{{$TransaksiSelesai->count()}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-2">
          <div class="dropdown-divider"></div>
          {{-- <a href="#" class="dropdown-item"> --}}
            {{-- notifikasi pemberitahuan dari pemilik laundry --}}
            <i class="fas fa-envelope mr-2"></i> {{$TransaksiSelesai->count()}} Pemberitahuan laundry selesai <br>
            @foreach($TransaksiSelesai as $selesai)
              <span>{{$selesai->laundry->nama_laundry}}</span> <br>
              @if($selesai->transaction->transaksi_status == 'selesai')
                <small>(Laundry anda telah selesai dan akan diantar.)</small> 
              @endif
              <span class="float-right text-muted text-sm">
                {{\Carbon\Carbon::createFromTimeStamp(strtotime($selesai->transaction->updated_at))->diffForHumans()}}
              </span> <br>
            @endforeach
          {{-- </a> --}}
          <div class="dropdown-divider"></div>
          <a href="{{route('riwayat-laundry-saya')}}" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li> -->
      @endif
    </ul>
  </nav>