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
{{--
    <link rel="shortcut icon" href="{{asset('/admin_1529321/assets/images/favicon.ico')}}">
--}}

    <!-- App css -->
    <link href="{{asset('/admin_1529321/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons -->

    <link href="{{asset('/admin_1529321/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

</head>

<!-- body start -->
<body data-menu-color="light" data-sidebar="default">

<!-- Begin page -->
<div id="app-layout">


    <!-- Topbar Start -->
    <!-- end Topbar -->

    <!-- Left Sidebar Start -->
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="">
        <div class="">

            <!-- Start Content-->
            <div class="">
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
                            {{ session('success') }} | Popup'ı kapatabilirsiniz.
                        </div>
                    @endif

                    <!-- Error Alert -->
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                        </div>
                    @endif



                @yield('content')

            </div> <!-- container-fluid -->
        </div> <!-- content -->



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


</body>
</html>
