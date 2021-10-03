
<header class="header-section">
    <!-- <div class="header-top">
        <div class="container">
            <div class="ht-left">
                <div class="mail-service">
                    <i class=" fa fa-envelope"></i> 
                </div>
                <div class="phone-service"> 
                    <i class=" fa fa-phone"></i> 
                </div>
            </div>
        </div>
    </div> -->
    <div class="container">
        <div class="inner-header">
            {{-- <div class="row "> --}}
                {{-- <div class=""> --}}
                <div class="d-flex justify-content-between"> 
                    <div class="logo">
                        <a href="{{url('/')}}" style="font-size: 23px;">
                            <strong class="text-warning">Laundry'in </strong> Aja
                        </a>
                    </div>
                    {{-- </div> --}}
                    <div class=" logo">
                        @auth
                            Hallo, {{Auth::user()->name}} &nbsp; / &nbsp; 
                            <a href="{{route('home')}}" style="a:hover">Dashboard</a> /
                            <a href="{{url('/logout')}}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                              <i class="fa fa-sign-out text-danger"></i>
                            </a>
                            <form id="logout-form" action="{{url('/logout')}}" method="POST" style="display: none;">
                              @csrf
                            </form>
                        @else
                            <a href="{{route('login')}}" class="btn btn-sm btn-success px-4"> Login</a>
                            <a href="{{route('register')}}" class="btn btn-sm btn-warning px-4"> Register</a>
                        @endauth
                    </div>
                </div>
            {{-- </div> --}}
        </div>
    </div>
</header>

<style>
    a:hover{
        color: #111;
    }
</style>