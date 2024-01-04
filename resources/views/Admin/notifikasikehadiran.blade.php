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
                        <button type="submit" class="btn btn-danger text-center"
                            style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">
                            <i class="fas fa-sign-out-alt me-1" style="font-size: 0.8rem;"></i> Logout
                        </button>
                    </form>

                </div>

        </nav>

        <div class="container">
            <button class="btn btn-primary mt-2 ms-1 mb-2" data-bs-toggle="modal" data-bs-target="#tambahModal"
                style="background-color: #3498db; border-color: #3498db; color: #ffffff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); border-radius: 20px;">
                <i class="fas fa-plus"></i> Tambah Notifikasi
            </button>

            <div class="card mt-0 mx-auto"
                style="max-width: 1000px; width: 100%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-bottom: 20px;">
                <div class="card-header bg-primary text-white">
                    <h5 class="text-center">Daftar Notifikasi Kehadiran</h5>
                </div>
                <div class="card-body p-3">
                    <table class="table table-bordered table-striped mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Kelas</th>
                                <th class="text-center">Jurusan</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Jenis Notifikasi</th>
                                <th class="text-center">Informasi Tambahan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notifikasikehadiran as $notifikasi)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $notifikasi->user->name }}</td>
                                    <td class="text-center">{{ $notifikasi->kelas->tingkat_kelas }}</td>
                                    <td class="text-center">{{ $notifikasi->kelas->jurusan }}</td>
                                    <td class="text-center">{{ $notifikasi->tanggal_notifikasi }}</td>
                                    <td class="text-center">{{ $notifikasi->jenis_notifikasi }}</td>
                                    <td class="text-center">{{ $notifikasi->informasi_tambahan }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-warning btn-sm me-auto" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $notifikasi->id }}" style="font-size: 0.8rem;">
                                            <i class="fas fa-pen"></i> Edit
                                        </button>

                                        <form action="{{ route('destroy', $notifikasi->id) }}" method="post" class="mt-2">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" id="btn-delete"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                                                style="font-size: 0.8rem;">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- modal tambah -->

        <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Notifikasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form method="POST" action="{{ route('notifikasikehadiran.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="id_siswa">Nama siswa</label>
                                <select class="form-select" name="id_siswa" id="id_siswa">
                                    <option value="">Pilih siswa</option>
                                    @foreach ($user as $siswa)
                                        @if ($siswa->hasRole('user'))
                                            <option value="{{ $siswa->id }}">{{ $siswa->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('id_siswa')
                                    <!-- Perhatikan perubahan di sini -->
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="kelas_id" class="form-label">Kelas</label>
                                <select class="form-select" id="kelas_id" name="kelas_id">
                                    <option value="" disabled {{ old('kelas_id') == '' ? 'selected' : '' }}>Pilih
                                        kelas</option>
                                    @foreach ($kelas as $kelasItem)
                                        <option value="{{ $kelasItem->id }}"
                                            {{ old('kelas_id') == $kelasItem->id ? 'selected' : '' }}>
                                            {{ $kelasItem->tingkat_kelas }} - {{ $kelasItem->jurusan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kelas_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Form for creating notifications -->
                            <div class="mb-3">
                                <label for="tanggal_notifikasi">Tanggal:</label>
                                <input type="date" class="form-control" id="tanggal_notifikasi"
                                    name="tanggal_notifikasi">
                                @error('tanggal_notifikasi')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="jenis_notifikasi">Jenis Notifikasi:</label>
                                <input type="text" class="form-control" id="jenis_notifikasi"
                                    name="jenis_notifikasi">
                                @error('jenis_notifikasi')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="informasi_tambahan">Informasi Tambahan:</label>
                                <textarea class="form-control" id="informasi_tambahan" name="informasi_tambahan" rows="3"></textarea>
                                @error('informasi_tambahan')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        @foreach ($notifikasikehadiran as $notifikasi)
            <div class="modal fade" id="editModal{{ $notifikasi->id }}" tabindex="-1"
                aria-labelledby="editModalLabel{{ $notifikasi->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel{{ $notifikasi->id }}">Edit Notifikasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('notifikasikehadiran.update', $notifikasi->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="id_siswa">Edit Siswa:</label>
                                    <select class="form-select" name="id_siswa" id="id_siswa">
                                        <option value="" disabled>Pilih siswa</option>
                                        @foreach ($user as $siswa)
                                            @if ($siswa->hasRole('user'))
                                                <option value="{{ $siswa->id }}">{{ $siswa->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('edit_id_siswa')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="kelas_id" class="form-label">Kelas</label>
                                    <select class="form-select" id="kelas_id" name="kelas_id">
                                        <option value="" disabled {{ old('kelas_id') == '' ? 'selected' : '' }}>
                                            Pilih kelas</option>
                                        @foreach ($kelas as $kelasItem)
                                            <option value="{{ $kelasItem->id }}"
                                                {{ $notifikasi->kelas_id == $kelasItem->id ? 'selected' : '' }}>
                                                {{ $kelasItem->tingkat_kelas }} - {{ $kelasItem->jurusan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('edit_kelas_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_notifikasi">Tanggal:</label>
                                    <input type="date" class="form-control" id="tanggal_notifikasi"
                                        name="tanggal_notifikasi" value="{{ $notifikasi->tanggal_notifikasi }}">
                                    @error('edit_tanggal_notifikasi')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_notifikasi">Jenis Notifikasi:</label>
                                    <input type="text" class="form-control" id="jenis_notifikasi"
                                        name="jenis_notifikasi" value="{{ $notifikasi->jenis_notifikasi }}">
                                    @error('edit_jenis_notifikasi')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="informasi_tambahan">Informasi Tambahan:</label>
                                    <textarea class="form-control" id="informasi_tambahan" name="informasi_tambahan" rows="3">{{ $notifikasi->informasi_tambahan }}</textarea>
                                    @error('edit_informasi_tambahan')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endsection
