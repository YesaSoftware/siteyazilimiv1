<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8" />
    <title>@yield('title') | {{$_SERVER['HTTP_HOST']}} Yönetim Paneli</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc."/>
    <meta name="author" content="Zoyothemes"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin_v3/assets/images/favicon.ico') }}">

    @if (View::hasSection('datatable'))

    <!-- Datatables css -->
    <link href="{{ asset('admin_v3/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_v3/assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_v3/assets/libs/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_v3/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_v3/assets/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />

    @endif
    <!-- App css -->
    <link href="{{ asset('admin_v3/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons -->
    <link href="{{ asset('admin_v3/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css"
    >

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script>
        function showAlertBasic(iconType, alertTitle, alertText, confirmButtonTextColor = '#3085d6') {
            Swal.fire({
                title: alertTitle,
                html: alertText,
                icon: iconType,
                allowOutsideClick: false,
                confirmButtonText: 'Tamam',
                confirmButtonColor: confirmButtonTextColor
            });
        }
    </script>

</head>

<!-- body start -->
<body data-menu-color="dark" data-sidebar="default">

<!-- Begin page -->
<div id="app-layout">


    <!-- Topbar Start -->
    <div class="topbar-custom">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
                    <li>
                        <button class="button-toggle-menu nav-link">
                            <i data-feather="menu" class="noti-icon"></i>
                        </button>
                    </li>
                    <li class="d-none d-lg-block">
                        <div class="position-relative topbar-search">
                            <input type="text" class="form-control bg-light bg-opacity-75 border-light ps-4" placeholder="Search...">
                            <i class="mdi mdi-magnify fs-16 position-absolute text-muted top-50 translate-middle-y ms-2"></i>
                        </div>
                    </li>
                </ul>
                <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">

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
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
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


                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item text-muted link-primary">
                                    <div class="notify-icon">
                                        <img src="{{asset('admin_v3/assets/images/users/user-6.jpg')}}" class="img-fluid rounded-circle" alt="" />
                                    </div>
                                    <div class="notify-content">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <p class="notify-details">Jocab jones</p>
                                            <small class="text-muted">7 min ago</small>
                                        </div>
                                        <p class="mb-1 user-msg">
                                            <small class="fs-14">Mentioned you in the <span class="text-reset text-truncate">Rewrite text-button</span></small>
                                        </p>
                                        <p class="noti-mentioned p-2 rounded-2 mb-0 mt-2"><span class="text-reset">@Patryk</span> Please make sure that you're....</p>
                                    </div>
                                </a>
                            </div>

                            <!-- All-->
                            <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                View all
                                <i class="fe-arrow-right"></i>
                            </a>

                        </div>
                    </li>

                    <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="{{asset('admin_v3/assets/images/users/user-11.jpg')}}" alt="user-image" class="rounded-circle">
                            <span class="pro-user-name ms-1">
                                        {{auth()->user()->name}} <i class="mdi mdi-chevron-down"></i>
                                    </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome !</h6>
                            </div>

                            <!-- item-->
                            <a href="pages-profile.html" class="dropdown-item notify-item">
                                <i class="mdi mdi-account-circle-outline fs-16 align-middle"></i>
                                <span>My Account</span>
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
                    <a href="" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset('admin_v3/assets/images/logo-sm.png') }}" alt="" height="22">
                        </span>
                                        <span class="logo-lg">
                            <img src="{{ asset('admin_v3/assets/images/logo-light.png') }}" alt="" height="24">
                        </span>
                                    </a>
                                    <a href="{{ asset('index.html') }}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ asset('admin_v3/assets/images/logo-sm.png') }}" alt="" height="22">
                        </span>
                                        <span class="logo-lg">
                            <img src="{{ asset('admin_v3/assets/images/logo-dark.png') }}" alt="" height="24">
                        </span>
                    </a>
                </div>

                <ul id="side-menu">

                    <x-menu-item link="{{route('panel.home')}}" icon="fas fa-home" title="{{ __('sidebar.home') }}"/>

                    <x-menu-item icon="fas fa-earth-america" title="{{__('sidebar.site_operations.title')}}" :items="[
                                    ['route'=>'panel.languages.list', 'title' => 'sidebar.language_operations.list'],
                    ]"/>

                    <x-menu-item icon="fa fa-user-shield" title="sidebar.role_operations.title" :items="[
                                    ['route'=>'panel.roles.list', 'title' => 'sidebar.role_operations.list']]"/>

                    <x-menu-item icon="fas fa-users" title="{{__('sidebar.user_operations.title')}}" :items="[
                                    ['route'=>'panel.users.list', 'title' => 'sidebar.user_operations.list'],
                                    ['route'=>'panel.users.create', 'title' => 'sidebar.user_operations.create']
                    ]"/>

                    <x-menu-item icon="fas fa-cogs" title="{{__('sidebar.system_settings.title')}}" :items="[
                                    ['route'=>'panel.system.settings.list', 'title' => 'sidebar.system_settings.list'],
                                    ['route'=>'panel.logs.list', 'title' => 'sidebar.system_settings.logs']
                    ]"/>

                    <x-menu-item icon="fas fa-earth-america" title="{{__('sidebar.language_operations.title')}}" :items="[
                                    ['route'=>'panel.languages.list', 'title' => 'sidebar.language_operations.list'],
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

                    <div class="text-end">
                        <ol class="breadcrumb m-0 py-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Panel</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
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

                    <script>
                        let errors = @json($errors->all());
                       // showAlertBasic('error', 'Hata!', errors.join('<br>') );
                    </script>
                @endif

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                    </div>

                    <script>
                        // showAlertBasic('success', 'Başarılı!', '{{ session('success') }}');
                    </script>
                @endif

                <!-- Error Alert -->
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                    </div>
                    <script>
                        // showAlertBasic('error', 'Hata!', '{{ session('error') }}');
                    </script>
                @endif

                @yield('content')
            </div> <!-- container-fluid -->

        </div> <!-- content -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col fs-13 text-muted text-center">
                        &copy; <script>document.write(new Date().getFullYear())</script> - Made with <span class="mdi mdi-heart text-danger"></span> by <a href="#!" class="text-reset fw-semibold">dev32</a>
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
<script src="{{ asset('admin_v3/assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin_v3/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin_v3/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('admin_v3/assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('admin_v3/assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('admin_v3/assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('admin_v3/assets/libs/feather-icons/feather.min.js') }}"></script>
@if (View::hasSection('datatable'))

<!-- Datatables js -->
<script src="{{ asset('admin_v3/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>

<!-- dataTables.bootstrap5 -->
<script src="{{ asset('admin_v3/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('admin_v3/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>

<!-- buttons.colVis -->
<script src="{{ asset('admin_v3/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('admin_v3/assets/libs/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('admin_v3/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin_v3/assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>

<!-- buttons.bootstrap5 -->
<script src="{{ asset('admin_v3/assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>

<!-- dataTables.keyTable -->
<script src="{{ asset('admin_v3/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('admin_v3/assets/libs/datatables.net-keytable-bs5/js/keyTable.bootstrap5.min.js') }}"></script>

<!-- dataTable.responsive -->
<script src="{{ asset('admin_v3/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin_v3/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>

<!-- dataTables.select -->
<script src="{{ asset('admin_v3/assets/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('admin_v3/assets/libs/datatables.net-select-bs5/js/select.bootstrap5.min.js') }}"></script>

<!-- Datatable Demo App Js -->
<script src="{{ asset('admin_v3/assets/js/pages/datatable.init.js') }}"></script>

@endif

<!-- App js -->
<script src="{{ asset('admin_v3/assets/js/app.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


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

    function sendAjaxRequest(method, url, data, onSuccess, onError) {
        $.ajax({
            url: url,
            type: method,
            headers: {
                'Authorization': 'Bearer ' + "{{session('token')}}"
            },
            data: data,
            success: function (response) {
                if (typeof onSuccess === 'function') {
                    onSuccess(response);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
                if (typeof onError === 'function') {
                    onError(jqXHR, textStatus, errorThrown);
                }
            }
        });
    }



    function populateSelectDropdown(url, selectElementId, preselectedIds = []) {
        sendAjaxRequest('GET', url, {}, function (response) {
            let options = response.data;
            let selectElement = $(selectElementId);
            selectElement.empty();

            options.forEach(function (option) {
                let isSelected = preselectedIds.includes(option.id);
                selectElement.append(
                    `<option value="${option.id}" ${isSelected ? 'selected' : ''}>${option.name}</option>`
                );
            });
        });
    }

    function confirmAndDeleteRow(url) {
        Swal.fire({
            title: 'Emin misiniz?',
            text: "Bu işlemi geri alamazsınız!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet, Sil!',
            cancelButtonText: 'İptal',
            allowOutsideClick: false,
        }).then((result) => {
            if (result.isConfirmed) {
                sendAjaxRequest('DELETE', url, '', function (response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        $('#WCE_DataTable').DataTable().ajax.reload();
                    } else {
                        showAlertBasic('error', 'Hata!', response.message);
                    }
                });
            }
        });
    }

    function openModal(modalId) {
        $(modalId).modal('show');
    }

    function closeModal(modalId) {
        $(modalId).modal('hide');
    }

    console.clear();

</script>


</body>
</html>
