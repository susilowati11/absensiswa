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
                        <button type="submit" class="btn btn-primary` text-center">Logout</button>
                    </form>

                </div>

        </nav>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahKehadiranModal">
            + Kehadiran
        </button>

        <table class="table mt-1 ms-1">
            <thead class="table-light">

                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Siswa</th>
                        <th class="text-center">Kelas</th>
                        <th class="text-center">Jurusan</th>
                        {{-- <th class="text-center">Tanggal</th> --}}
                        <th class="text-center">Status Kehadiran</th>
                        {{-- <th class="text-center">Waktu Masuk</th>
                        <th class="text-center">Waktu Pulang</th> --}}
                        {{-- <th class="text-center">Catatan</th> --}}
                        {{-- <th class="text-center">Aksi</th> --}}
                    </tr>
                </thead>
            <tbody>
                @foreach ($kehadiran as $absis)
                    <tr>
                        <th class="text-center">{{ $loop->iteration }}</th>
                        <td class="text-center">{{ $absis->user->name }}</td>
                        <td class="text-center">{{ $absis->kelas->tingkat_kelas }}</td>
                        <td class="text-center">{{ $absis->kelas->jurusan }}</td>
                        {{-- <td class="text-center">{{ $absis->tanggal }}</td> --}}
                        <td class="text-center">{{ $absis->status_kehadiran }}</td>
                        {{-- <td class="text-center">{{ $absis->waktu_masuk }}</td>
                        <td class="text-center">{{ $absis->waktu_pulang }}</td> --}}
                        {{-- <td class="text-center">{{ $absis->catatan }}</td> --}}
                       
                        {{-- <td>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editKehadiranModal-{{ $absis->id }}"
                                data-link="{{ $absis->siswa_id }}">
                                Edit
                            </button>
                            <form id="deleteForm{{ $absis->id }}" action="{{ route('kehadiran.destroy', $absis->id) }}"
                                method="POST" style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm ms-auto" id="btn-delete"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td> --}}
                    </tr>
                    {{-- <div class="modal fade" id="editKehadiranModal-{{ $absis->id }}" tabindex="-1"
                        aria-labelledby="editKehadiranModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editKehadiranModalLabel">Edit Kehadiran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div> --}}
                                {{-- <div class="modal-body">
                                    <form action="{{ route('kehadiran.update', $absis->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="nama_siswa">Edit Siswa:</label>
                                            <select class="form-select" name="id_siswa" id="id_siswa">
                                                <option value="" disabled>pilih siswa</option>
                                                @foreach ($user as $siswa)
                                                    <option value="{{ $siswa->id }}">{{ $siswa->name }}</option>
                                                @endforeach
                                            </select>
                                        </div> --}}
                                        
                                        {{-- <div class="mb-3">
                                            <label for="tanggal" class="form-label">Tanggal:</label>
                                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                                value="{{ $absis->tanggal }}" required> --}}
                                            {{-- <div class="form-group">
                                                <label for="status_kehadiran" class="form-label">Status Kehadiran</label>
                                                <select class="form-select" id="status_kehadiran" name="status_kehadiran"
                                                    required>
                                                    <option value="hadir"
                                                        {{ $absis->status_kehadiran == 'hadir' ? 'selected' : '' }}>Hadir
                                                    </option>
                                                    <option value="tidak hadir"
                                                        {{ $absis->status_kehadiran == 'tidak hadir' ? 'selected' : '' }}>
                                                        Tidak hadir</option>
                                                    <option value="izin"
                                                        {{ $absis->status_kehadiran == 'izin' ? 'selected' : '' }}>Izin
                                                    </option>
                                                </select>
                                            </div> --}}
                                            {{-- <div class="form-group">
                                                <label for="kelas_id" class="form-label">Kelas</label>
                                                <select class="form-select" id="kelas_id" name="kelas_id" required>
                                                    <option value="" disabled {{ old('kelas_id') == '' ? 'selected' : '' }}>Pilih kelas</option>
                                                    @foreach ($kelas as $kelasItem)
                                                        <option value="{{ $kelasItem->id }}" {{ $kelasItem->id == $absis->kelas_id ? 'selected' : '' }}>
                                                            {{ $kelasItem->tingkat_kelas }} - {{ $kelasItem->jurusan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div> --}}
                                            {{-- <div class="mb-3">
                                                <label for="waktu_masuk" class="form-label">Waktu Masuk:</label>
                                                <input type="time" class="form-control" id="waktu_masuk"
                                                    name="waktu_masuk" value="{{ $absis->waktu_masuk }}" required>
                                            </div> --}}
                                            {{-- <div class="mb-3">
                                                <label for="waktu_pulang" class="form-label">Waktu Pulang:</label>
                                                <input type="time" class="form-control" id="waktu_pulang"
                                                    name="waktu_pulang" value="{{ $absis->waktu_pulang }}" required>
                                            </div> --}}
                                            {{-- <div class="mb-3">
                                                <label for="catatan" class="form-label">Catatan:</label>
                                                <input type="text" class="form-control" id="catatan" name="catatan"
                                                    value="{{ $absis->catatan }}" required>
                                            </div> --}}
                                            {{-- <button type="submit" class="btn btn-primary">Simpan</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button> --}}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="tambahKehadiranModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kehadiran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('kehadiran.store') }}">
                        @csrf
                        {{-- <div class="mb-3">
                            <label for="nama_siswa">Nama Siswa:</label>
                            <select class="form-select" name="id_siswa" id="id_siswa">
                                <option value="" disabled>pilih siswa</option>
                                @foreach ($user as $nama_siswa)
                                      <option value="{{ $nama_siswa->id}}">{{ $nama_siswa->name}}</option>
                                @endforeach
                            </select>
                        </div> --}}

                        {{-- <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal:</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div> --}}
                        <div class="form-group">
                            <label for="status_kehadiran" class="form-label">Status Kehadiran</label>
                            <select class="form-select" id="status_kehadiran" name="status_kehadiran" required>
                                <option value="hadir" {{ old('hadir') == 'hadir' ? 'selected' : '' }}>
                                    Hadir</option>
                                {{-- <option value="tidak hadir" {{ old('tidak hadir') == 'tidak hadir' ? 'selected' : '' }}>
                                    Tidak Hadir</option>
                                <option value="izin" {{ old('izin') == 'izin' ? 'selected' : '' }}>
                                    Izin</option> --}}
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kelas_id" class="form-label">Kelas</label>
                            <select class="form-select" id="kelas_id" name="kelas_id" required>
                                <option value="" disabled {{ old('kelas_id') == '' ? 'selected' : '' }}>Pilih kelas</option>
                                @foreach ($kelas as $kelasItem)
                                    <option value="{{ $kelasItem->id }}" {{ old('kelas_id') == $kelasItem->id ? 'selected' : '' }}>
                                        {{ $kelasItem->tingkat_kelas }} - {{ $kelasItem->jurusan }}
                                    </option>
                                @endforeach
                            </select>
                            
                        </div>
                        {{-- <div class="mb-3">
                            <label for="waktu_masuk" class="form-label">Waktu Masuk:</label>
                            <input type="time" class="form-control" id="waktu_masuk" name="waktu_masuk" required>
                        </div> --}}
                        {{-- <div class="mb-3">
                            <label for="waktu_pulang" class="form-label">Waktu Pulang:</label>
                            <input type="time" class="form-control" id="waktu_pulang" name="waktu_pulang" required>
                        </div> --}}
                        {{-- <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan:</label>
                            <input type="text" class="form-control" id="catatan" name="catatan" required>
                        </div> --}}
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                    </form>
                </div>
            </div>
        </div>
    </div>



    {{-- 
            Include SweetAlert styles  --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
