<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="{{ request()->is('admin/dashboard') || request()->is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard.index') }}">
                    <i class="{{ request()->is('admin') || request()->is('admin/dashboard') ? 'bx bx-category-alt bx-flashing' : 'bx bx-category-alt' }}" ></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span>
                </a>
            </li>

            <li class=" navigation-header"><span data-i18n="Application">Application</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="Application"></i>
            </li>

            {{-- @can('management_access') --}}
                <li class=" nav-item"><a href="#"><i class="bx bx-customize "></i>
                    <span class="menu-title" data-i18n="Management Access">Master Data</span></a>
                    <ul class="menu-content">
                        <li class="{{ request()->is('admin/pic') ? 'active' : '' }} ">
                            <a class="menu-item" href="{{ route('admin.pic.index') }}">
                                <i></i><span>PIC</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('admin/bussinesUnit') ? 'active' : '' }} ">
                            <a class="menu-item" href="{{ route('admin.bussinesUnit.index') }}">
                                <i></i><span>Bussines Unit</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('admin/department') ? 'active' : '' }} ">
                            <a class="menu-item" href="{{ route('admin.department.index') }}">
                                <i></i><span>Department</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('admin/user') ? 'active' : '' }} ">
                            <a class="menu-item" href="{{ route('admin.user.index') }}">
                                <i></i><span>User</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('admin/kategori') ? 'active' : '' }} ">
                            <a class="menu-item" href="{{ route('admin.kategori.index') }}">
                                <i></i><span>Kategori</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('admin/soal') ? 'active' : '' }} ">
                            <a class="menu-item" href="{{ route('admin.soal.index') }}">
                                <i></i><span>Soal</span>
                            </a>
                        </li>                    
                    </ul>
                </li>

                <li class=" nav-item"><a href="#"><i class="bx bx-group"></i><span class="menu-title" data-i18n="Transaksi">Transaksi</span></a>
                    <ul class="menu-content">

                            <li class="{{ request()->is('admin/request') ? 'active' : '' }} ">
                                <a class="menu-item" href="{{ route('admin.request.index') }}">
                                    <i></i><span>Request</span>
                                </a>
                            </li>

                    </ul>
                </li>

                <li class=" nav-item"><a href="#"><i class="fa fa-cog"></i><span class="menu-title" data-i18n="Settings">   Settings</span></a>
                    <ul class="menu-content">
                        <li class="{{ request()->is('admin/announcement') ? 'active' : '' }} ">
                            <a class="menu-item" href="{{ route('admin.announcement.index') }}">
                                <i></i><span>Announcement</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('admin/rules') ? 'active' : '' }} ">
                            <a class="menu-item" href="{{ route('admin.rules.index') }}">
                                <i></i><span>Rules</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="fas fa-file-export"></i><span class="menu-title" data-i18n="Export">Export</span></a>
                    <ul class="menu-content">
                        <li class="{{ request()->is('/user') ? 'active' : '' }} ">
                            <a class="menu-item" href="{{ route('user.exportExcel') }}">
                                <i></i><span>Export to Excel</span>
                            </a>
                        </li>
                    </ul>
                </li>
        </ul>
    </div>
</div>

<!-- END: Main Menu-->
