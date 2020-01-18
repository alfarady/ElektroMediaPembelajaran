<!-- Sidebar -->
<nav id="sidebar">
    <!-- Sidebar Content -->
    <div class="sidebar-content">
        <!-- Side Header -->
        <div class="content-header content-header-fullrow px-15">
            <!-- Mini Mode -->
            <div class="content-header-section sidebar-mini-visible-b">
                <!-- Logo -->
                <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                    <span class="text-dual-primary-dark">c</span><span class="text-primary">b</span>
                </span>
                <!-- END Logo -->
            </div>
            <!-- END Mini Mode -->

            <!-- Normal Mode -->
            <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                <!-- Close Sidebar, Visible only on mobile screens -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                    <i class="fa fa-times text-danger"></i>
                </button>
                <!-- END Close Sidebar -->

                <!-- Logo -->
                <div class="content-header-item">
                    <a class="link-effect font-w700" href="/dashboard">
                        <img width="30" height="30" src="https://img2.pngdownload.id/20180503/dcq/kisspng-pos-indonesia-mail-point-of-sale-logo-indonesia-5aeb329c06fe29.0749394715253633560287.jpg"></img>
                        <span class="font-size-xl text-dual-primary-dark">SIMAS</span><span class="font-size-xl" style="color: orange">POS</span>
                    </a>
                </div>
                <!-- END Logo -->
            </div>
            <!-- END Normal Mode -->
        </div>
        <!-- END Side Header -->

        <!-- Side User -->
        <div class="content-side content-side-full content-side-user px-10 align-parent">
            <!-- Visible only in mini mode -->
            <div class="sidebar-mini-visible-b align-v animated fadeIn">
                <img class="img-avatar img-avatar32" src="{{ asset('media/avatars/avatar15.jpg') }}" alt="">
            </div>
            <!-- END Visible only in mini mode -->

            <!-- Visible only in normal mode -->
            <div class="sidebar-mini-hidden-b text-center">
                <a class="img-link" href="javascript:void(0)">
                    <img class="img-avatar" src="{{ asset('media/avatars/avatar15.jpg') }}" alt="">
                </a>
                <ul class="list-inline mt-10">
                    <li class="list-inline-item">
                        <a class="link-effect text-dual-primary-dark font-size-xs font-w600 text-uppercase" href="javascript:void(0)">J. Smith</a>
                    </li>
                    <li class="list-inline-item">
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <a class="link-effect text-dual-primary-dark" data-toggle="layout" data-action="sidebar_style_inverse_toggle" href="javascript:void(0)">
                            <i class="si si-drop"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a class="link-effect text-dual-primary-dark" href="javascript:void(0)">
                            <i class="si si-logout"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- END Visible only in normal mode -->
        </div>
        <!-- END Side User -->

        <!-- Side Navigation -->
        <div class="content-side content-side-full">
            <ul class="nav-main">
                <li>
                    <a class="{{ request()->is('dashboard') ? ' active' : '' }}" href="/dashboard">
                        <i class="si si-cup"></i><span class="sidebar-mini-hide">Home</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('dashboard') ? ' active' : '' }}" href="/dashboard">
                        <i class="si si-cup"></i><span class="sidebar-mini-hide">Semua Surat</span>
                    </a>
                </li>
                <li class="{{ request()->is('examples/*') ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-bulb"></i><span class="sidebar-mini-hide">Data Master</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('examples/plugin') ? ' active' : '' }}" href="/examples/plugin">Deputy</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('examples/blank') ? ' active' : '' }}" href="/examples/blank">Kategori</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('examples/blank') ? ' active' : '' }}" href="/examples/blank">Sub Kategori</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="{{ request()->is('dashboard') ? ' active' : '' }}" href="/dashboard">
                        <i class="si si-cup"></i><span class="sidebar-mini-hide">User Management</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- Sidebar Content -->
</nav>
<!-- END Sidebar -->