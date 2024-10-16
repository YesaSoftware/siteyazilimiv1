<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8"/>
    <title>@yield('title') | {{$_SERVER['HTTP_HOST']}} Yönetim Paneli</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc."/>
    <meta name="author" content="Zoyothemes"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <!-- App favicon -->
    {{--
        <link rel="shortcut icon" href="{{asset('/admin_1529321/assets/images/favicon.ico')}}">
    --}}

    <!-- App css -->
    <link href="{{asset('/admin_1529321/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style"/>

    <!-- Icons -->

    <link href="{{asset('/admin_1529321/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>

    @if (View::hasSection('datatable'))

        <link href="{{ asset('admin_1529321/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}"
              rel="stylesheet" type="text/css"/>
        <link href="{{ asset('admin_1529321/assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}"
              rel="stylesheet" type="text/css"/>
        <link
            href="{{ asset('admin_1529321/assets/libs/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css') }}"
            rel="stylesheet" type="text/css"/>
        <link
            href="{{ asset('admin_1529321/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
            rel="stylesheet" type="text/css"/>
        <link href="{{ asset('admin_1529321/assets/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css') }}"
              rel="stylesheet" type="text/css"/>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css"
    >


</head>

<!-- body start -->
<body data-menu-color="light" data-sidebar="default">

<!-- Modal HTML -->
<!-- Modal HTML -->
<div class="modal fade" id="urlPopup" tabindex="-1" role="dialog" aria-labelledby="urlPopupLabel" aria-hidden="true"
     data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        onclick="document.getElementById('urlFrameModal_Url').src = '' " aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 0;">
                <iframe id="urlFrameModal_Url" src="" style="width: 100%; height: 100vh;" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>

<!-- CSS -->
<style>
    .modal-backdrop {
        pointer-events: none; /* Modal arka planına tıklamayı engeller */
    }

    .modal-content {
        pointer-events: auto; /* Modal içeriğine tıklamayı aktif hale getirir */
    }

    .modal-body {
        max-height: 70vh; /* Modal içeriği için maksimum yükseklik */
        overflow-y: auto; /* Dikey kaydırma çubuğunu göster */
    }
</style>

<!-- Begin page -->
<div id="app-layout">


    <!-- Topbar Start -->
    <div class="topbar-custom">
        <div class="container-xxl">
            <div class="d-flex justify-content-between">
                <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
                    <li>
                        <button class="button-toggle-menu nav-link ps-0">
                            <i data-feather="menu" class="noti-icon"></i>
                        </button>
                    </li>
                    <li class="d-none d-lg-block">
                        <div class="position-relative topbar-search">
                            <input type="text" class="form-control bg-light bg-opacity-75 border-light ps-4"
                                   placeholder="Search...">
                            <i class="mdi mdi-magnify fs-16 position-absolute text-muted top-50 translate-middle-y ms-2"></i>
                        </div>
                    </li>
                </ul>

                <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">

                    <li class="d-none d-sm-flex">
                        <button type="button" class="btn nav-link" data-toggle="fullscreen">
                            <i data-feather="maximize" class="align-middle fullscreen noti-icon"></i>
                        </button>
                    </li>

                    <!-- Aktif Dil Seçici Buton -->
                    <li class="d-none d-sm-flex">
                        <div class="dropdown">
                            <!-- Dil Butonu (Aktif Dili Gösterir) -->
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <!-- Font Awesome Bayrak İkonu ve Seçili Dili Göster -->
                                <i class="fas fa-globe"></i>
                                @if (App::getLocale() == 'tr')
                                    🇹🇷 Türkçe
                                @else
                                    🇺🇸 English
                                @endif
                            </button>

                            <!-- Dil Seçenekleri -->
                            <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                                <!-- Türkçe Dil Seçeneği -->
                                <li>
                                    <a class="dropdown-item" href="{{ route('set.language', ['lang' => 'tr']) }}">
                                        🇹🇷 Türkçe
                                    </a>
                                </li>
                                <!-- İngilizce Dil Seçeneği -->
                                <li>
                                    <a class="dropdown-item" href="{{ route('set.language', ['lang' => 'en']) }}">
                                        🇺🇸 English
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>


                    <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                           aria-haspopup="false" aria-expanded="false">
                            <i data-feather="bell" class="noti-icon"></i>
                            <span class="badge bg-danger rounded-circle noti-icon-badge">9</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-lg">

                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h5 class="m-0">
                                            <span class="float-end">
                                                <a href="" class="text-dark">
                                                    <small>Clear All</small>
                                                </a>
                                            </span>Notification
                                </h5>
                            </div>

                            <div class="noti-scroll" data-simplebar>

                                <!-- item-->
                                <a href="javascript:void(0);"
                                   class="dropdown-item notify-item text-muted link-primary active">
                                    <div class="notify-icon">
                                        <img src="{{asset('/admin_1529321/assets/images/users/user-12.jpg')}}"
                                             class="img-fluid rounded-circle" alt=""/>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <p class="notify-details">Carl Steadham</p>
                                        <small class="text-muted">5 min ago</small>
                                    </div>
                                    <p class="mb-0 user-msg">
                                        <small class="fs-14">Completed <span class="text-reset">Improve workflow in Figma</span></small>
                                    </p>
                                </a>
                            </div>

                        </div>
                    </li>

                    <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#"
                           role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="{{asset('/admin_1529321/assets/images/users/user-11.jpg')}}" alt="user-image"
                                 class="rounded-circle">
                            <span class="pro-user-name ms-1">
                                        {{auth()->user()->name}} <i class="mdi mdi-chevron-down"></i>
                                    </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end profile-dropdown ">

                            <!-- item-->
                            <a href="pages-profile.html" class="dropdown-item notify-item">
                                <i class="mdi mdi-account-circle-outline fs-16 align-middle"></i>
                                <span>Hesabım</span>
                            </a>



                            <!-- item-->
                            <a href="auth-lock-screen.html" class="dropdown-item notify-item">
                                <i class="mdi mdi-lock-outline fs-16 align-middle"></i>
                                <span>Lock Screen</span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <!-- item-->
                            <a href="auth-logout.html" class="dropdown-item notify-item">
                                <i class="mdi mdi-location-exit fs-16 align-middle"></i>
                                <span>Logout</span>
                            </a>

                        </div>
                    </li>

                </ul>
            </div>

        </div>

    </div>
    <!-- end Topbar -->

    <!-- Left Sidebar Start -->
    <div class="app-sidebar-menu">
        <div class="h-100" data-simplebar>

            <!--- Sidemenu -->
            <div id="sidebar-menu">

                <div class="logo-box">
                    <a href="index.html" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset('/admin_1529321/assets/images/logo-sm.png') }}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('/admin_1529321/assets/images/logo-light.png') }}" alt="" height="24">
                        </span>
                    </a>
                    <a href="index.html" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ asset('/admin_1529321/assets/images/logo-sm.png') }}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('/admin_1529321/assets/images/logo-dark.png') }}" alt="" height="24">
                        </span>
                    </a>

                </div>

                <ul id="side-menu">
                    <li class="menu-title mt-2">{{ __('sidebar.general') }}</li>
                    <x-menu-item link="{{route('panel.home')}}" icon="home" title="{{ __('sidebar.home') }}"/>


                    <x-menu-item icon="user-check" title="sidebar.role_operations.title" :items="[
                                    ['route'=>'panel.roles.list', 'name' => 'sidebar.role_operations.list']]"/>

                    <x-menu-item icon="users" title="{{__('sidebar.user_operations.title')}}" :items="[
                                    ['route'=>'panel.users.list', 'name' => 'sidebar.user_operations.list'],
                                    ['route'=>'panel.users.create', 'name' => 'sidebar.user_operations.create']

                    ]"/>

                    <x-menu-item id="sidebarError" icon="alert-octagon" title="Error Pages" :items="[
                            ['link' => 'error-404.html', 'name' => 'Error 404'],
                            ['link' => 'error-500.html', 'name' => 'Error 500'],
                            ['link' => 'error-503.html', 'name' => 'Error 503'],
                            ['link' => 'error-429.html', 'name' => 'Error 429'],
                            ['link' => 'offline-page.html', 'name' => 'Offline Page']
                    ]"/>

                </ul>

            </div>
            <!-- End Sidebar -->

            <div class="clearfix"></div>

        </div>
    </div>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-xxl">

                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0">@yield('title')</h4>
                    </div>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Error Alert -->
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <!-- Kullanıcı bilgileri -->

                @yield('content')

            </div> <!-- container-fluid -->
        </div> <!-- content -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col fs-13 text-muted text-center">
                        &copy;
                        <script>document.write(new Date().getFullYear())</script>
                        - Made with <span class="mdi mdi-heart text-danger"></span> by <a href="#!"
                                                                                          class="text-reset fw-semibold">Test</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->

    </div>
    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

</div>
<!-- END wrapper -->

<!-- Vendor -->
<script src="{{asset('/admin_1529321/assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('/admin_1529321/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/admin_1529321/assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('/admin_1529321/assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{asset('/admin_1529321/assets/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('/admin_1529321/assets/libs/jquery.counterup/jquery.counterup.min.js')}}"></script>
<script src="{{asset('/admin_1529321/assets/libs/feather-icons/feather.min.js')}}"></script>


<!-- App js-->
<script src="{{asset('/admin_1529321/assets/js/app.js')}}"></script>
@if (View::hasSection('datatable'))
    <!-- Datatables js -->
    <script src="{{ asset('admin_1529321/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>

    <!-- dataTables.bootstrap5 -->
    <script src="{{ asset('admin_1529321/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin_1529321/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>

    <!-- buttons.colVis -->
    <script src="{{ asset('admin_1529321/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('admin_1529321/assets/libs/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('admin_1529321/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin_1529321/assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>

    <!-- buttons.bootstrap5 -->
    <script
        src="{{ asset('admin_1529321/assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>

    <!-- dataTables.keyTable -->
    <script
        src="{{ asset('admin_1529321/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script
        src="{{ asset('admin_1529321/assets/libs/datatables.net-keytable-bs5/js/keyTable.bootstrap5.min.js') }}"></script>

    <!-- dataTable.responsive -->
    <script
        src="{{ asset('admin_1529321/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script
        src="{{ asset('admin_1529321/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>

    <!-- dataTables.select -->
    <script src="{{ asset('admin_1529321/assets/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <script
        src="{{ asset('admin_1529321/assets/libs/datatables.net-select-bs5/js/select.bootstrap5.min.js') }}"></script>
@endif

<!-- Datatable Demo App Js -->

<script>
    function popup(url, title = 'popup', w = 1200, h = 800) {
        var dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : screen.left;
        var dualScreenTop = window.screenTop !== undefined ? window.screenTop : screen.top;

        var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

        var left = ((width / 2) - (w / 2)) + dualScreenLeft;
        var top = ((height / 2) - (h / 2)) + dualScreenTop;
        var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

        if (window.focus) {
            newWindow.focus();
        }
    }

    function disableButton(form) {
        const button = document.getElementById('submitButton');
        button.disabled = true;
        button.style.display = 'none';
        const loadingMessage = document.getElementById('loadingMessage');
        loadingMessage.style.display = 'flex';

        return true;
    }
</script>

</body>
</html>
