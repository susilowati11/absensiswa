<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ABSEN SISWA</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Tambahkan Bootstrap dan jQuery di sini -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Tambahkan CSS Bootstrap di sini -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-6e2b/+9cI+qXaip4qK8Fvfn3baNTIpF8h+VjFf6J6I5U0qGQ5T6MIYH21Ub5vEJ5tXG1FBaFBLBsr6HnQYzFw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->

        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3"
                    style="text-decoration: none; color: #3498db; transition: color 0.3s;">
                    <h3 class="text-primary"
                        style="font-family: 'Arial', sans-serif; font-weight: bold; margin: 0; transition: color 0.3s;">
                        ABSEN SISWA
                    </h3>
                </a>
                <style>
                    /* CSS untuk efek hover */
                    .navbar-brand:hover h3 {
                        color: #e74c3c;
                        /* Ganti warna saat di-hover */
                    }
                </style>

                <div class="d-flex align-items-center ms-4 mb-4 text-center">
                    <div class="ms-3 mx-auto text-center">
                        <span
                            style="font-size: 1.2rem; font-weight: bold; color: #3498db;" class="ms-5">{{ Auth::user()->name }}</span>
                    </div>
                </div>

                <div class="navbar-nav w-100">
                    @if (Auth::user()->role == 'admin')
                        <a href="{{ route('home') }}" class="nav-item nav-link {{ Request::is('/*') ? 'active' : '' }}">
                            <i class="fa fa-home me-2"></i>Dashboard
                        </a>
                        <hr class="my-1">
                        <a href="{{ route('kelas') }}"
                            class="nav-item nav-link {{ Request::is('kelas*') ? 'active' : '' }}">
                            <i class="fa fa-chalkboard"></i>Kelas
                        </a>
                        <hr class="my-1">
                        <a href="{{ route('riwayatkehadiran') }}"
                            class="nav-item nav-link {{ Request::is('riwayatkehadiran*') ? 'active' : '' }}">
                            <i class="fa fa-history"></i>Riwayat Kehadiran
                        </a>
                        <hr class="my-1">
                        <a href="{{ route('notifikasikehadiran') }}"
                            class="nav-item nav-link {{ Request::is('notifikasikehadiran*') ? 'active' : '' }}">
                            <i class="fa fa-bell"></i>Notifikasi
                        </a>
                        <hr class="my-1">
                        <a href="{{ route('datasiswa') }}"
                            class="nav-item nav-link {{ Request::is('datasiswa*') ? 'active' : '' }}">
                            <i class="fa fa-table"></i>Data Siswa
                        </a>
                    @else
                        <a href="{{ route('home') }}"
                            class="nav-item nav-link {{ Request::is('/*') ? 'active' : '' }}">
                            <i class="fa fa-home me-2"></i>Dashboard
                        </a>
                        <hr class="my-1">
                        <a href="{{ route('siswa') }}"
                            class="nav-item nav-link {{ Request::is('siswa*') ? 'active' : '' }}">
                            <i class="fa fa-user-circle fa-1x"></i>Profil Siswa
                        </a>
                        <hr class="my-1">
                        <a href="{{ route('kehadiran') }}"
                            class="nav-item nav-link {{ Request::is('kehadiran*') ? 'active' : '' }}">
                            <i class="fa fa-clipboard-check"></i>Kehadiran
                        </a>
                        <hr class="my-1">
                        <a href="{{ route('notifikasi-siswa') }}" class="nav-item nav-link">
                            <i class="fa fa-bell"></i>Notifikasi Siswa
                        </a>
                    @endif
                </div>
            </nav>
        </div>
        @yield('content')
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
