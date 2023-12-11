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
            <div class="navbar-nav align-items-center ms-auto">
                <div class="nav-item dropdown">
                <!-- Tambahkan formulir logout di dalam dropdown-menu -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary text-center">Logout</button>
                </form>

            </div>

        </nav>
        <!-- ... (Kode Navbar) ... -->

        <table class="table mt-1 ms-1">
            <thead class="table-light">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama siswa</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Kelas</th>
                    <th class="text-center">Jurusan</th>
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
                        <td class="text-center">{{ $absis->nama_siswa }}</td>
                        <td class="text-center">{{ $absis->tanggal }}</td>
                        <td class="text-center">{{ $absis->kelas->tingkat_kelas }}</td>
                        <td class="text-center">{{ $absis->kelas->jurusan }}</td>
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
