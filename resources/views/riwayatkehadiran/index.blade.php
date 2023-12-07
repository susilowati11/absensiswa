@extends('layouts.sidebar')
@section('content')
    <div class="content">
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
            <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
            </a>
            <a href="#" class="sidebar-toggler flex-shrink-0">
                <i class="fa fa-bars"></i>
            </a>
            {{-- <form class="d-none d-md-flex ms-4">
                <input class="form-control border-0" type="search" placeholder="Search">
            </form> --}}
            <div class="navbar-nav align-items-center ms-auto">
                <div class="nav-item dropdown">

                    {{-- <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        <a href="#" class="dropdown-item">
                            <h6 class="fw-normal mb-0">Profile updated</h6>
                            <small>15 minutes ago</small>
                        </a>
                        <hr class="dropdown-divider">
                        <a href="#" class="dropdown-item">
                            <h6 class="fw-normal mb-0">New user added</h6>
                            <small>15 minutes ago</small>
                        </a>
                        <hr class="dropdown-divider">
                        <a href="#" class="dropdown-item">
                            <h6 class="fw-normal mb-0">Password changed</h6>
                            <small>15 minutes ago</small>
                        </a>
                        <hr class="dropdown-divider">
                        <a href="#" class="dropdown-item text-center">See all notifications</a>
                    </div>
                </div> --}}
                <div class="nav-item dropdown">
                    {{-- <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <img class="rounded-circle me-lg-2" src="img/user.jpg" alt=""
                            style="width: 40px; height: 40px;">
                        <span class="d-none d-lg-inline-flex">John Doe</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        <a href="#" class="dropdown-item">My Profile</a>
                        <a href="#" class="dropdown-item">Settings</a>
                        <a href="#" class="dropdown-item">Log Out</a>
                    </div> --}}
                </div>
            </div>
        </nav>
        <!-- ... (Kode Navbar) ... -->

        <table class="table mt-1 ms-1">
            <thead class="table-light">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama siswa</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Status Kehadiran</th>
                    <th class="text-center">Waktu Masuk</th>
                    <th class="text-center">Waktu Pulang</th>
                    <th class="text-center">Catatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayatKehadiran as $absis)
                {{-- @dd($absis) --}}
                    <tr>
                        <td class="text-center">{{ $absis->id }}</td>
                        <td class="text-center">{{ $absis->siswa->nama_siswa }}</td>
                        <td class="text-center">{{ $absis->tanggal }}</td>
                        <td class="text-center">{{ $absis->status_kehadiran }}</td>
                        <td class="text-center">{{ $absis->waktu_masuk }}</td>
                        <td class="text-center">{{ $absis->waktu_pulang }}</td>
                        <td class="text-center">{{ $absis->catatan }}</td>
                        <td class="text-center">
                            <!-- Tambahkan tombol atau aksi lain sesuai kebutuhan -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
