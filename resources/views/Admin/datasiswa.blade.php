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
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary text-center">Logout</button>
                    </form>
                </div>
            </div>
        </nav>

        <button class="btn btn-primary mt-2 ms-1" data-bs-toggle="modal" data-bs-target="#tambahModal">
            <i class="fas fa-plus"></i> Tambah Siswa</button>

        <table class="table mt-1 ms-1">
            <thead class="table-light">
                <tr>
                    <th class="text-center">Nama Siswa</th>
                    <th class="text-center">NIS</th>
                    <th class="text-center">Kelas</th>
                    <th class="text-center">Jenis Kelamin</th>
                    <th class="text-center">Tanggal Lahir</th>
                    <th class="text-center">Alamat</th>
                    <th class="text-center">Nomor Telepon</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datasiswa as $siswa)
                    <tr>
                        <td class="text-center">{{ $siswa->name }}</td>
                        <td class="text-center">{{ $siswa->nis }}</td>
                        <td class="text-center">{{ $siswa->kelas->tingkat_kelas }} - {{ $siswa->kelas->jurusan }}                        </td>
                        <td class="text-center">{{ $siswa->jenis_kelamin }}</td>
                        <td class="text-center">{{ $siswa->tanggal_lahir }}</td>
                        <td class="text-center">{{ $siswa->alamat }}</td>
                        <td class="text-center">{{ $siswa->no_tlp }}</td>
                        <td class="text-center">{{ $siswa->email }}</td>
                        <td class="text-center">
                            <!-- modal update -->
                            <button class="btn btn-success btn-sm me-auto" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $siswa->id }}">
                                <i class="fas fa-pen"></i> Edit
                            </button>
                            <br><br>
                            <form action="{{ route('datasiswa.destroy', $siswa->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm ms-auto" id="btn-delete"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal Tambah Siswa -->
        <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Siswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('datasiswa.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama siswa</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="nis" class="form-label">NIS</label>
                                <input type="text" class="form-control" id="nis" name="nis" required>
                            </div>
                            <div class="form-group">
                                <label for="kelas_id" class="form-label">Kelas</label>
                                <select class="form-select" id="kelas_id" name="kelas_id" required>
                                    <option value="" disabled selected>Pilih kelas</option>
                                    @foreach ($kelas as $kelasItem)
                                        <option value="{{ $kelasItem->id }}">{{ $kelasItem->tingkat_kelas }} -
                                            {{ $kelasItem->jurusan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="" disabled selected>Pilih jenis kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="no_tlp" class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control" id="no_tlp" name="no_tlp" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @foreach ($datasiswa as $siswa)
            <div class="modal fade" id="editModal{{ $siswa->id }}" tabindex="-1"
                aria-labelledby="editModalLabel{{ $siswa->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel{{ $siswa->id }}">Edit Siswa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            {{-- {{ $siswa->id }} --}}
                            <form method="POST" action="{{ route('datasiswa.update', $siswa->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="name">Nama siswa</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $siswa->name }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nis">NIS</label>
                                    <input type="text" class="form-control" id="nis" name="nis"
                                        value="{{ $siswa->nis }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="kelas_id" class="form-label">Kelas</label>
                                    <select class="form-select" id="kelas_id" name="kelas_id" required>
                                        <option value="" disabled selected>Pilih kelas</option>
                                        @foreach ($kelas as $kelasItem)
                                            <option value="{{ $kelasItem->id }}"
                                                {{ $siswa->kelas_id == $kelasItem->id ? 'selected' : '' }}>
                                                {{ $kelasItem->tingkat_kelas }} - {{ $kelasItem->jurusan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="" disabled selected>Pilih jenis kelamin</option>
                                        <option value="Laki-laki"
                                            {{ $siswa->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan"
                                            {{ $siswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                        value="{{ $siswa->tanggal_lahir }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ $siswa->alamat }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="no_tlp">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="no_tlp" name="no_tlp"
                                        value="{{ $siswa->no_tlp }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $siswa->email }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach



    </div>

    <!-- Your Modals Here -->
@endsection
