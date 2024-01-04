<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Simple Responsive Admin</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="{{ asset('assets/css/font-awesome.css') }}" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryvalidate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>

<body>



    <div id="wrapper">
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="adjust-nav">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <img src="assets/img/logo.png" />

                    </a>

                </div>

                <span class="logout-spn">
                    <a href="{{ route('logout') }}" style="color:#fff;">LOGOUT</a>

                </span>
            </div>
        </div>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    @guest
                        <li>
                            <a href="{{ route('login') }}"><i class="fa fa-user "></i>Login</a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}"><i class="fa fa-edit "></i>Register</a>
                        </li>
                    @else
                        <li class="active-link">
                            <a href="{{ route('dashboard') }}"><i class="fa fa-desktop "></i>Dashboard </a>
                        </li>


                        <li>
                            <a href="{{ route('users.index') }}"><i class="fa fa-users "></i>Manage Users </a>
                        </li>
                        <li>
                            <a href="{{ route('roles.index') }}"><i class="fa fa-gear "></i>Manage Roles </a>
                        </li>


                        <li>
                            <a href="{{ route('lokasi_uang.index') }}"><i class="fa fa-map-marker"></i>Lokasi Uang</a>
                        </li>
                        <li>
                            <a href="{{ route('uang_masuk.index') }}"><i class="fa fa-arrow-down"></i>Uang Masuk</a>
                        </li>

                        <li>
                            <a href="{{ route('uang_keluar.index') }}"><i class="fa fa-arrow-up"></i>Uang Keluar</a>
                        </li>

                    </ul>
                </div>
            </nav>
        @endguest
        @yield('content')
    </div>


    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    {{-- <script src="{{ asset('assets/js/jquery-1.10.2.js') }}"></script> --}}
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- CUSTOM SCRIPTS -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>


</body>

</html>
