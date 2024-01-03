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

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary text-center">Logout</button>
                    </form>
                </div>
        </nav>

        <div class="container mt-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahKehadiranModal">
                + Kehadiran
            </button>
        </div>
        
            <div class="card mt-3 mx-auto" style="max-width: 1000px; width: 100%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-bottom: 20px;">
                <div class="card-header bg-primary text-white">
                    <h5 class="text-center">Daftar Kehadiran Siswa</h5>
                </div>
                <div class="card-body p-3">
                    <table class="table table-bordered table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Siswa</th>
                                <th class="text-center">Kelas</th>
                                <th class="text-center">Jurusan</th>
                                <th class="text-center">Status Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kehadiran as $absis)
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
        
    <!-- Modal -->
    <div class="modal fade" id="tambahKehadiranModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kehadiran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('kehadiran.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="status_kehadiran" class="form-label">Status Kehadiran</label>
                            <select class="form-select" id="status_kehadiran" name="status_kehadiran">
                                <option value="" selected disabled>Pilih Status Kehadiran</option>
                                <option value="hadir" {{ old('status_kehadiran') == 'hadir' ? 'selected' : '' }}>
                                    Hadir
                                </option>
                            </select>
                            @error('status_kehadiran')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="kelas_id" class="form-label">Kelas</label>
                            <select class="form-select" id="kelas_id" name="kelas_id">
                                <option value="" disabled {{ old('kelas_id') == '' ? 'selected' : '' }}>Pilih kelas
                                </option>
                                @foreach ($kelas as $kelasItem)
                                    <option value="{{ $kelasItem->id }}"
                                        {{ old('kelas_id') == $kelasItem->id ? 'selected' : '' }}>
                                        {{ $kelasItem->tingkat_kelas }} - {{ $kelasItem->jurusan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kelas_id')
                                <P class="text-danger">{{ $message }}</P>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
