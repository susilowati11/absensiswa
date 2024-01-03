@extends('layouts.sidebar')

@section('content')
    <div class="content">
        <!-- ... (Kode Navbar) ... -->
        <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
            <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
            </a>
            <a href="#" class="sidebar-toggler flex-shrink-0">
                <i class="fa fa-bars"></i>
            </a>
            <div class="navbar-nav align-items-center ms-auto">
                <div class="nav-item dropdown">

                    <form action="{{ route('logout') }}" method="POST" class="d-flex align-items-center">
                        @csrf
                        <button type="submit" class="btn btn-danger text-center" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">
                            <i class="fas fa-sign-out-alt me-1" style="font-size: 0.8rem;"></i> Logout
                        </button>
                    </form>
                </div>
        </nav>
        <div class="my-3">
            <form action="{{ route('riwayatkehadiran') }}" method="get" class="mx-auto">
                <div class="row justify-content-end">
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <label for="tanggal" class="me-2" style="font-weight: bold; text-align: center; display: block;">Tanggal Awal:</label>
                            <input type="date" name="tanggal" value="{{ request('tanggal', session('tanggal')) }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <label for="tanggal" class="me-2" style="font-weight: bold; text-align: center; display: block;">Status Kehadiran:</label>
                            <select name="status_kehadiran" class="form-select">
                                <option value="" {{ !request()->has('status_kehadiran') ? 'selected' : '' }}>Semua Status</option>
        
                                <option value="Hadir"{{ request('status_kehadiran') === 'Hadir' ? ' selected' : '' }}>Hadir
                                </option>
                                <option
                                    value="Tidak Hadir"{{ request('status_kehadiran') === 'Tidak Hadir' ? ' selected' : '' }}>
                                    Tidak Hadir</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
            <div class="container">
                <div class="card mt-3 mx-auto"
                    style="max-width: 1000px; width: 100%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-bottom: 20px;">
                    <div class="card-header bg-primary text-white">
                        <h5 class="text-center">Riwayat Kehadiran Siswa</h5>
                    </div>
                    <div class="card-body p-3">
                        <table class="table table-bordered table-striped">
                        <thead class="table-light">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama siswa</th>
                                    <th class="text-center">Kelas</th>
                                    <th class="text-center">Jurusan</th>
                                    <th class="text-center">Status Kehadiran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayatKehadiran as $absis)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $absis->user->name }}</td>
                                        <td class="text-center">{{ $absis->kelas->tingkat_kelas }}</td>
                                        <td class="text-center">{{ $absis->kelas->jurusan }}</td>
                                        <td class="text-center">{{ $absis->status_kehadiran }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endsection
