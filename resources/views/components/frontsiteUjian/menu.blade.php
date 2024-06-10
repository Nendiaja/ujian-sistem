<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="{{ request()->is('user/dashboard') || request()->is('user/dashboard') ? 'active' : '' }}">
                <a href="{{ route('user.dashboard.index') }}">
                    <i class="{{ request()->is('user') || request()->is('user/dashboard') ? 'bx bx-category-alt bx-flashing' : 'bx bx-category-alt' }}" ></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span>
                </a>
            </li>

            <li class=" navigation-header"><span data-i18n="Application">Application</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="Application"></i>
            </li>

            

            {{-- @can('master_data_access') --}}
                <li class=" nav-item"><a href="#"><i class="bx bx-group"></i><span class="menu-title" data-i18n="Master Data">Transaksi</span></a>
                    <ul class="menu-content">

                        {{-- @can('specialist_access') --}}
                            <li class="{{ request()->is('backsite/absensi') ? 'active' : '' }} ">
                                <a class="menu-item" href="">
                                    <i></i><span>Ujian</span>
                                </a>
                            </li>
                        {{-- @endcan --}}
                    </ul>
                </li>
            {{-- @endcan --}}

            
        </ul>
    </div>
</div>

<!-- END: Main Menu-->
