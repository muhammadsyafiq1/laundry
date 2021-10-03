<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <span class="brand-text text-warning">Laundry'in  </span> <span class="text-primary">Aja</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if (Auth::user()->avatar)
              <img src="{{ Storage::url(Auth::user()->avatar) }}" class="img-circle elevation-2">
          @else
              <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" height="60" class="img-circle elevation-2" />
          @endif
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{route('home')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Profile
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('profile')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lihat Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('setting-profile')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Setting Profile</p>
                </a>
              </li>
            </ul>
          </li>

           @if(Auth::user()->roles == 1)
            <li class="nav-item">
              <a href="{{route('user.index')}}" class="nav-link">
                <i class="nav-icon fa fa-users"></i>
                <p>
                  Data Pengguna
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('laundry-all')}}" class="nav-link">
                <i class="nav-icon fa fa-tshirt"></i>
                <p>
                  Laundry Terdaftar
                </p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="{{route('banner.index')}}" class="nav-link">
                <i class="nav-icon fa fa-picture-o"></i>
                <p>
                  Set banner
                </p>
              </a>
            </li>     
          @endif

           @if(Auth::user()->roles == 3)
          <li class="nav-item">
            <a href="{{route('riwayat-laundry-saya')}}" class="nav-link">
              <i class="fa fa-history nav-icon"></i>
              <p>Status Laundry saya</p>
            </a>
          </li>
           <li class="nav-item">
            <a href="{{route('ulasan.index')}}" class="nav-link">
              <i class="fa fa-quote-left nav-icon"></i>
              <p>Ulasan</p>
            </a>
          </li>
           @endif
          

          @if(Auth::user()->roles == 2)


           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-tshirt"></i>
              <p>
                Manage Laundry
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('laundry.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                 Laundry
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('gallery.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                 Gallery Laundry
                </p>
              </a>
            </li>
            </ul>
          </li>
            <li class="nav-item">
              @php
                $TransaksiPending = App\Models\Transaction_detail::with(['transaction.user','laundry.gallery'])
            ->whereHas('laundry', function($laundry){$laundry->where('user_id', Auth::user()->id);})
            ->whereHas('transaction', function($laundry){$laundry->where('transaksi_status', '=' ,'pending');})
            ->count(); 
              @endphp
              <a href="{{route('transaction.riwayat-pengguna')}}" class="nav-link">
                <i class="nav-icon fa fa-book"></i>
                <p>
                  Data Laundry Masuk 
                  @if($TransaksiPending)
                    <span class="text-dark badge badge-warning navbar-badge" style="font-size: 12px;">
                      {{$TransaksiPending}}
                    </span>
                  @endif
                </p>
              </a>
            </li>
          @endif

          <li class="nav-item">
            <a href="{{url('/logout')}}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
            <form id="logout-form" action="{{url('/logout')}}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>