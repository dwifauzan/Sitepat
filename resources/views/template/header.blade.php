<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LATELINK SMAKENSA</title>

    <!-- Google Font: Source Sans Pro -->
    {{-- poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    {{-- dm sans --}}
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../../plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
    {{-- datatables --}}
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            @if (Auth::user()->role_id == 1)
            <!-- <li class="nav-item mr-4">
                <form action="{{ route('reset') }}" method="post">
                    @csrf
                    <button type="submit" class="nav-link rounded btn btn-danger" style="font-family: 'Poppins', sans-serif; color: white;">Reset</button>
                </form>
            </li> -->
            @endif
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="nav-link rounded btn btn-warning" style="font-family: 'Poppins', sans-serif; color: white;">logout</button>
                </form>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar elevation-4 pl-1" style="background-color: #E62027;">
        <!-- Brand Logo -->
        <a href="" class="brand-link">
            <h1 class="brand-text fw-bold font-weight-light text-capitalize" style="text-decoration: none; color: white; font-family: 'Poppins', sans-serif;">latelink</h1>
        </a>
        @auth
            <div class="d-flex">
                <div class="info d-flex align-items-center">
                    <div>
                        <p class="brand-text text-capitalize fw-bold text-light m-2 rounded p-2 shadow"
                            style="font-size: 1em; font-family: 'Poppins', sans-serif; background-color: #BB393E;">Role Saat ini {{ auth()->user()->name }}</p>
                    </div>
                </div>
            </div>
        @else

        <!-- Sidebar -->
        <div class="sidebar">
                <div class="user-panel d-flex">
                    <div class="info">
                        <a href="{{ route('login') }}" class="d-block">Login dahulu!</a>
                    </div>
                </div>
            @endauth

            <!-- Sidebar Menu -->
            <nav class="sidebar">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-header text-capitalize" style="font-family: 'Poppins', sans-serif; font-size: 1em; color: white;">Grafik Telat</li>
                        <li class="nav-item">
                            <a href="{{ route('dash') }}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt" style="color: white;"></i>
                                <p class="text-capitalize" style="font-family: 'DM Sans', sans-serif; font-size: 1em; color: white;">
                                    dashboard
                                    {{-- <i class="far fa-circle nav-icon"></i> --}}
                                    {{-- <i class="right fas fa-angle-left"></i> --}}
                                </p>
                            </a>
                        </li>

                    @if (Auth::user()->role_id == 1)
                    {{-- fitur --}}
                    <li class="nav-header text-capitalize" style="font-family: 'Poppins', sans-serif; font-size: 1em; color: white;">Manage Data</li>
                    {{-- manage data siswa --}}
                    <li class="nav-item">
                        <a href="{{ route('manage') }}" class="nav-link">
                            <i class="nav-icon fas fa-users" style="color: white;"></i>
                            <p class="text-capitalize" style="font-family: 'DM Sans', sans-serif; font-size: 1em; color: white;">
                                kelola datasiswa
                                {{-- <i class="fas fa-angle-left right"></i> --}}
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('create') }}" class="nav-link">
                            <i class="nav-icon fas fa-edit" style="color: white;"></i>
                            <p class="text-capitalize" style="font-family: 'DM Sans', sans-serif; font-size: 1em; color: white;">
                                tambah siswa
                                {{-- <i class="fas fa-angle-left right"></i> --}}
                            </p>
                        </a>
                    </li>

                    {{-- manage jurusan --}}
                    <li class="nav-item">
                        <a href="{{ route('jurusan') }}" class="nav-link">
                            <i class="nav-icon fas fa-flask" style="color: white;"></i>
                            <p class="text-capitalize" style="font-family: 'DM Sans', sans-serif; font-size: 1em; color: white;">
                                kelola jurusan
                                {{-- <i class="fas fa-angle-left right"></i> --}}
                            </p>
                        </a>
                    </li>

                    {{-- manage kelas --}}
                    <li class="nav-item">
                        <a href="{{ route('kelas') }}" class="nav-link">
                            <i class="nav-icon fas fa-building" style="color: white;"></i>
                            <p class="text-capitalize" style="font-family: 'DM Sans', sans-serif; font-size: 1em; color: white;">
                                kelola kelas
                                {{-- <i class="fas fa-angle-left right"></i> --}}
                            </p>
                        </a>
                    </li>

                    @endif
                    {{-- fitur --}}
                    <li class="nav-header text-capitalize" style="font-family: 'Poppins', sans-serif; font-size: 1em; color: white;">fitur qrscan / qrcode</li>
                    {{-- manage data siswa --}}
                    <li class="nav-item">
                        <a href="{{ route('lateTable') }}" class="nav-link">
                            <i class="nav-icon far fa-circle" style="color: white;"></i>
                            <p class="text-capitalize" style="font-family: 'DM Sans', sans-serif; font-size: 1em; color: white;">
                                terlambat
                                {{-- <i class="fas fa-angle-left right"></i> --}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('scanSiswa') }}" class="nav-link">
                            <i class="nav-icon fas fa-qrcode" style="color: white;"></i>
                            <p class="text-capitalize" style="font-family: 'DM Sans', sans-serif; font-size: 1em; color: white;">
                                scan siswa
                                {{-- <i class="fas fa-angle-left right"></i> --}}
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
