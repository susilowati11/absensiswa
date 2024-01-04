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
                    
                    <form action="{{ route('logout') }}" method="POST" class="d-flex align-items-center">
                        @csrf
                        <button type="submit" class="btn btn-danger text-center" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">
                            <i class="fas fa-sign-out-alt me-1" style="font-size: 0.8rem;"></i> Logout
                        </button>
                    </form>
                </div>
        </nav>
        <div class="container">
            <div class="card mt-3 mx-auto" style="max-width: 1000px; width: 100%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-bottom: 20px;">
                <div class="card-header bg-primary text-white"> <!-- Mengganti bg-light dengan bg-primary dan text-white -->
                    <h5 class="text-center">Notifikasi Siswa</h5>
                </div>
                <div class="card-body p-3">
                    <table class="table table-bordered table-light mb-0">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Siswa</th>
                                <th class="text-center">Jenis Notifikasi</th>
                                <th class="text-center">Catatan</th>
                            </tr>
                        </thead>    
                        <tbody>
                            @foreach ($notifikasiSiswa as $notifikasi)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    {{-- <td class="text-center">{{ $notifikasi->id }}</td> --}}
                                    <td class="text-center">{{ $notifikasi->user->name }}</td>
                                    <td class="text-center">{{ $notifikasi->jenis_notifikasi }}</td>
                                    <td class="text-center">{{ $notifikasi->informasi_tambahan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>        
@endsection

