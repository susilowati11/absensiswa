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
                </div>
            </div>
        </nav>

        <button class="btn btn-primary mt-2 ms-1" data-bs-toggle="modal" data-bs-target="#tambahModal">
            <i class="fas fa-plus"></i> Tambah Siswa</button>

        <table class="table mt-1 ms-1">
            <thead class="table-light">

                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama Siswa</th>
                    <th class="text-center">NIS</th>
                    <th class="text-center">Kelas</th>
                    <th class="text-center">jurusan</th>
                    <th class="text-center">Jenis Kelamin</th>
                    <th class="text-center">Tanggal Lahir</th>
                    <th class="text-center">Alamat</th>
                    <th class="text-center">No Tlp</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">foto</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswa as $absis)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $absis->nama_siswa }}</td>
                        <td>{{ $absis->nis }}</td>
                        <td>{{ $absis->kelas->tingkat_kelas }}</td>
                        <td>{{ $absis->kelas->jurusan }}</td>
                        <td>{{ $absis->jenis_kelamin }}</td>
                        <td>{{ $absis->tanggal_lahir }}</td>
                        <td>{{ $absis->alamat }}</td>
                        <td>{{ $absis->nomor_telepon }}</td>
                        <td>{{ $absis->email }}</td>
                        <td>
                            @if ($absis->foto)
                                <img src="{{ asset('storage/' . $absis->foto) }}" alt=""
                                    style="max-width: 100px; max-height: 100px;">
                            @else
                                <p>Tidak ada foto</p>
                            @endif
                        </td>

                        <td class="text-center">
                            <button class="btn btn-success btn-sm me-auto" data-bs-toggle="modal"
                                data-bs-target="#edit{{ $absis->id}}">
                                <i class="fas fa-pen"></i> Edit
                            </button>
                            <br><br>
                            <form action="{{ route('siswa.destroy', $absis->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm ms-auto" id="btn-delete"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash-can"></i> Hapus
                                </button>
                            </form>
                        </td>
                @endforeach
            </tbody>
        </table>

        {{-- //modal create tambah data --}}
        <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Tambah Siswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('create.siswa') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_siswa" class="form-label">Nama Siswa</label>
                                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" required>
                            </div>
                            <div class="mb-3">
                                <label for="nis" class="form-label">NIS</label>
                                <input type="number" class="form-control" id="nis" name="nis" required>
                            </div>
                            <div class="form-group">
                                <label for="kelas_id" class="form-label">Kelas</label>
                                    <select class="form-select" id="kelas_id" name="kelas_id" required>
                                        <option value="" disabled {{ old('kelas_id') == '' ? 'selected' : '' }}>Pilih kelas</option>
                                        @foreach ($kelas as $kelasItem)
                                            <option value="{{ $kelasItem->id }}"
                                                {{ old('kelas_id') == $kelasItem->id ? 'selected' : '' }}>
                                                {{ $kelasItem->tingkat_kelas }} - {{ $kelasItem->jurusan }}
                                </option>
                                        @endforeach
                                </select>
                                </div>
                            <div class="form-group">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>
                                        Laki-Laki</option>
                                    <option value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                                <input type="number" class="form-control" id="nomor_telepon" name="nomor_telepon"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="siswa_foto" class="form-label">Foto Siswa</label>
                                <input type="file" class="form-control" id="siswa_foto" name="foto">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        @foreach ($siswa as $absis)
            <div class="modal fade" id="edit{{ $absis->id }}" tabindex="-1"
                aria-labelledby="editModalLabel{{ $absis->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel{{ $absis->id }}">Edit Siswa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('siswa.update', $absis->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="mb-3">
                                    <label for="nama_siswa" class="form-label">Nama Siswa</label>
                                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa"
                                        value="{{ $absis->nama_siswa }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nis" class="form-label">NIS</label>
                                    <input type="number" class="form-control" id="nis" name="nis"
                                        value="{{ $absis->nis }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="kelas_id" class="form-label">Kelas</label>
                                    <select class="form-select" id="kelas_id" name="kelas_id" required>
                                        @foreach ($kelas as $kelasOption)
                                            <option value="{{ $kelasOption->id }}" @if ($kelasOption->kelas_id == $kelasOption->id) selected @endif>
                                                {{ $kelasOption->tingkat_kelas }}- {{ $kelasOption->jurusan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="laki-laki"
                                            {{ $absis->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>Laki-Laki</option>
                                        <option value="perempuan"
                                            {{ $absis->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                        required value="{{ $absis->tanggal_lahir }}">
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" required>{{ $absis->alamat }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                                    <input type="number" class="form-control" id="nomor_telepon" name="nomor_telepon"
                                        required value="{{ $absis->nomor_telepon }}">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required
                                        value="{{ $absis->email }}">
                                </div>
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto Siswa</label>
                                    <input type="file" class="form-control" id="foto" name="foto"
                                        value="{{ $absis->foto }}">
                                </div>
                                @if ($absis->foto)
                                    <div class="mb-3">
                                        <label for="photo" class="form-label">Foto Siswa Sekarang:</label>
                                        <img src="{{ asset('storage/' . $absis->foto) }}" alt="Photo"
                                            class="img-thumbnail" width="100">
                                    </div>
                                @endif

                                <!-- Add other fields for editing -->

                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endsection
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/chart/chart.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/tempusdominus/js/moment.min.js"></script>
<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="js/main.js"></script>
</body>

</html>
