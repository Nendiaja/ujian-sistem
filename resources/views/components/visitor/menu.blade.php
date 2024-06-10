<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="{{ request()->is('visitor/dashboard') || request()->is('visitor/dashboard') ? 'active' : '' }}">
                <a href="{{ route('visitor.dashboard.index') }}">
                    <i class="{{ request()->is('visitor') || request()->is('visitor/dashboard') ? 'bx bx-category-alt bx-flashing' : 'bx bx-category-alt' }}" ></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span>
                </a>
            </li>

            <li class=" navigation-header"><span data-i18n="Application">Application</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="Application"></i>
            </li>

            

            {{-- @can('master_data_access') --}}
                <li class=" nav-item"><a href="#"><i class="bx bx-group"></i><span class="menu-title" data-i18n="Master Data">Transaksi</span></a>
                    <ul class="menu-content">

                        {{-- @can('specialist_access') --}}
                            {{-- <li class="{{ request()->is('user/nilai') ? 'active' : '' }} ">
                                <a class="menu-item" href="{{ route('user.nilai.index') }}">
                                    <i></i><span>Nilai</span>
                                </a>
                            </li> --}}
                        {{-- @endcan --}}
                    </ul>
                </li>
            {{-- @endcan --}}

            
        </ul>
    </div>
</div>

<!-- END: Main Menu-->
