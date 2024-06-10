<!-- BEGIN: Header-->
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light bg-info navbar-shadow">
    <div class="navbar-wrapper">



        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">

                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"><span class="mr-1 user-name text-bold-700">Selamat Datang {{ Auth::user()->name ?? 'Anonymous' }}
                    </span><span class="avatar avatar-online"><img src="{{ asset('/assets/backsite/app-assets/images/portrait/small/avatar-s-24.png') }}" alt="avatar"><i></i></span></a>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="user-profile.html"><i class="ft-user"></i> Edit Profile</a>
                        <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('login.store') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="ft-power"></i> Logout
                            </a>
                            
                            <form id="logout-form" action="{{ route('login.store') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- END: Header-->
