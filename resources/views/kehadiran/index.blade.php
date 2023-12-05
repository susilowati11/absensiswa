@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-11 offset-lg-2">
                <div class="d-flex justify-content-between mb-3">
                    <h2>Data Kehadiran</h2>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#tambahKehadiranModal">
                        + Kehadiran
                    </button>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Status Kehadiran</th>
                            <th scope="col">Waktu Masuk</th>
                            <th scope="col">Waktu Pulang</th>
                            <th scope="col">Catatan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kehadiran as $absis)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $absis->nama_siswa }}</td>
                                <td>{{ $absis->tanggal }}</td>
                                <td>{{ $absis->status_kehadiran }}</td>
                                <td>{{ $absis->waktu_masuk }}</td>
                                <td>{{ $absis->waktu_pulang }}</td>
                                <td>{{ $absis->catatan }}</td>

                                <td>
                                    <a href="{{ route('kehadiran.update', $absis->id) }}" class="btn btn-warning btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editKehadiranModal{{ $absis->id }}">Edit</a>

                                    <form id="deleteForm{{ $absis->id }}"
                                        action="{{ route('kehadiran.destroy', $absis->id) }}" method="POST"
                                        style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="confirmDelete(event)">
                                            <i class="bi bi-trash"></i>Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
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
                                <div class="mb-3">
                                    <label for="siswa_id" class="form-label">Nama Siswa:</label>
                                    <select class="form-control" id="siswa_id" name="siswa_id" required>
                                        @foreach ($Siswa as $siswa)
                                            <option value="{{ $siswa->id }}"> {{ $siswa->nama_siswa }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                                
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal:</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                                </div>
                                <div class="form-group">
                                    <label for="status_kehadiran" class="form-label">Status Kehadiran</label>
                                    <select class="form-select" id="status_kehadiran" name="status_kehadiran" required>
                                        <option value="hadir" {{ old('hadir') == 'hadir' ? 'selected' : '' }}>
                                            Hadir</option>
                                        <option value="tidak_hadir"
                                            {{ old('tidak_hadir') == 'tidak_hadir' ? 'selected' : '' }}>
                                            Tidak Hadir</option>
                                        <option value="izin" {{ old('izin') == 'izin' ? 'selected' : '' }}>
                                            Izin</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="waktu_masuk" class="form-label">Waktu Masuk:</label>
                                    <input type="time" class="form-control" id="waktu_masuk" name="waktu_masuk" required>
                                </div>
                                <div class="mb-3">
                                    <label for="waktu_pulang" class="form-label">Waktu Pulang:</label>
                                    <input type="time" class="form-control" id="waktu_pulang" name="waktu_pulang"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="catatan" class="form-label">Catatan:</label>
                                    <input type="text" class="form-control" id="catatan" name="catatan" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @foreach ($kehadiran as $absis)
                <div class="modal fade" id="editKehadiranModal{{ $absis->id }}" tabindex="-1"
                    aria-labelledby="editKehadiranModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editKehadiranModalLabel">Edit Kehadiran</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('kehadiran.update', $absis->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="edit_nama_siswa" class="form-label">Nama Siswa:</label>
                                        <input type="text" class="form-control" id="edit_nama_siswa"
                                            name="nama_siswa" value="{{ $absis->nama_siswa }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_tanggal" class="form-label">Tanggal:</label>
                                        <input type="date" class="form-control" id="edit_tanggal" name="tanggal"
                                            value="{{ $absis->tanggal }}" required>
                                        <div class="form-group">
                                            <label for="status_kehadiran" class="form-label">Status Kehadiran</label>
                                            <select class="form-select" id="status_kehadiran" name="status_kehadiran"
                                                required>
                                                <option value="hadir"
                                                    {{ $absis->status_kehadiran == 'hadir' ? 'selected' : '' }}>Hadir
                                                </option>
                                                <option value="tidak_hadir"
                                                    {{ $absis->status_kehadiran == 'tidak_hadir' ? 'selected' : '' }}>Tidak
                                                    hadir</option>
                                                <option value="izin"
                                                    {{ $absis->status_kehadiran == 'izin' ? 'selected' : '' }}>Izinr
                                                </option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_waktu_masuk" class="form-label">Waktu Masuk:</label>
                                            <input type="time" class="form-control" id="edit_waktu_masuk"
                                                name="waktu_masuk" value="{{ $absis->waktu_masuk }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_waktu_pulang" class="form-label">Waktu Pulang:</label>
                                            <input type="time" class="form-control" id="edit_waktu_pulang"
                                                name="waktu_pulang" value="{{ $absis->waktu_pulang }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_catatan" class="form-label">Catatan:</label>
                                            <input type="text" class="form-control" id="edit_catatan" name="catatan"
                                                value="{{ $absis->catatan }}" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- <!-- Include SweetAlert styles -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            @if (session('error'))
                <script>
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        text: "Data masih digunakan"
                    })
                </script>
            @endif

            <script>
                function confirmDelete(event) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Apakah anda yakin ingin menghapus data?',
                        text: "Anda tidak akan dapat mengembalikan ini!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Submit the form if the user confirms
                            event.target.closest('form').submit();
                        }
                    });
                }
            </script>
        @endsection --}}
