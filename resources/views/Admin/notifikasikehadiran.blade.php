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
                    {{-- <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a> --}}
                    {{-- <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown"> --}}
                    {{-- <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a> --}}
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
                <!-- Tambahkan formulir logout di dalam dropdown-menu -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary text-center">Logout</button>
                </form>

            </div>

        </nav>

        <button class="btn btn-primary mt-2 ms-1" data-bs-toggle="modal" data-bs-target="#tambahModal">
            <i class="fas fa-plus"></i> Tambah Notifikasi</button>

        <table class="table mt-1 ms-1">
            <thead class="table-light">

                <tr>
                    <th class="text-center">nama</th>
                    <th class="text-center">kelas</th>
                    <th class="text-center">jurusan</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Waktu Notifikasi</th>
                    <th class="text-center">Jenis Notifikasi</th>
                    <th class="text-center">Status Pengiriman</th>
                    <th class="text-center">Informasi Tambahan</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($notifikasikehadiran as $notifikasi)
                    <tr>
                        <td class="text-center">{{ $notifikasi->siswa->nama_siswa }}</td>
                        <td class="text-center">{{ $notifikasi->siswa->kelas->tingkat_kelas }}</td>
                        <td class="text-center">{{ $notifikasi->siswa->kelas->jurusan }}</td>
                        <td class="text-center">{{ $notifikasi->tanggal_notifikasi }}</td>
                        <td class="text-center">{{ $notifikasi->waktu_notifikasi }}</td>
                        <td class="text-center">{{ $notifikasi->jenis_notifikasi }}</td>
                        <td class="text-center">{{ $notifikasi->status_pengiriman }}</td>
                        <td class="text-center">{{ $notifikasi->informasi_tambahan }}</td>
                        <td class="text-center">
                            <!-- modal update -->
                            <button class="btn btn-success btn-sm me-auto" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $notifikasi->id }}">
                                <i class="fas fa-pen"></i> Edit
                            </button>
                            <br><br>
                            <form action="{{ route('destroy', $notifikasi->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm ms-auto" id="btn-delete"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                @endforeach
            </tbody>
        </table>
        <!-- modal tambah -->

        <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Notifikasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form for selecting Siswa and Kelas -->
                        <form method="POST" action="{{ route('notifikasikehadiran.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="siswa_kelas">Pilih Siswa dan Kelas:</label>
                                <select class="form-control" id="siswa_kelas" name="siswa_kelas" required>
                                    @foreach ($siswa as $absis)
                                        <option value="{{ $absis->id }}">{{ $absis->nama_siswa }} - Kelas:
                                            {{ $absis->kelas->tingkat_kelas }} - {{ $absis->kelas->jurusan }}</option>
                                    @endforeach
                                </select>

                            </div>

                            <!-- Form for creating notifications -->
                            <div class="mb-3">
                                <label for="tanggal_notifikasi">Tanggal:</label>
                                <input type="date" class="form-control" id="tanggal_notifikasi"
                                    name="tanggal_notifikasi" required>
                            </div>
                            <div class="mb-3">
                                <label for="waktu_notifikasi">Waktu Notifikasi:</label>
                                <input type="time" class="form-control" id="waktu_notifikasi" name="waktu_notifikasi"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_notifikasi">Jenis Notifikasi:</label>
                                <input type="text" class="form-control" id="jenis_notifikasi" name="jenis_notifikasi"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="status_pengiriman">Status Pengiriman:</label>
                                <input type="text" class="form-control" id="status_pengiriman"
                                    name="status_pengiriman" required>
                            </div>
                            <div class="mb-3">
                                <label for="informasi_tambahan">Informasi Tambahan:</label>
                                <textarea class="form-control" id="informasi_tambahan" name="informasi_tambahan" rows="3"></textarea>
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
                                    <!-- Form for updating notifications -->
                                    <form method="POST" action="{{ route('notifikasikehadiran.update', $notifikasi->id) }}">
                                    @method('PUT')
                                        @csrf
                                        <div class="mb-3">
                                            <label for="siswa_kelas">Pilih Siswa dan Kelas:</label>
                                            <select class="form-control" id="siswa_kelas" name="siswa_kelas" required>
                                                @foreach ($siswa as $absis)
                                                    <option value="{{ $absis->id }}"
                                                        @if ($absis->id == $notifikasi->siswa_id) selected @endif>
                                                        {{ $absis->nama_siswa }} - Kelas:
                                                        {{ $absis->kelas->tingkat_kelas }} {{ $absis->kelas->jurusan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tanggal_notifikasi">Tanggal:</label>
                                            <input type="date" class="form-control" id="tanggal_notifikasi"
                                                name="tanggal_notifikasi" value="{{ $notifikasi->tanggal_notifikasi }}"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="waktu_notifikasi">Waktu Notifikasi:</label>
                                            <input type="time" class="form-control" id="waktu_notifikasi"
                                                name="waktu_notifikasi" value="{{ $notifikasi->waktu_notifikasi }}"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="jenis_notifikasi">Jenis Notifikasi:</label>
                                            <input type="text" class="form-control" id="jenis_notifikasi"
                                                name="jenis_notifikasi" value="{{ $notifikasi->jenis_notifikasi }}"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="status_pengiriman">Status Pengiriman:</label>
                                            <input type="text" class="form-control" id="status_pengiriman"
                                                name="status_pengiriman" value="{{ $notifikasi->status_pengiriman }}"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="informasi_tambahan">Informasi Tambahan:</label>
                                            <textarea class="form-control" id="informasi_tambahan" name="informasi_tambahan" rows="3">{{ $notifikasi->informasi_tambahan }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
    @endsection
