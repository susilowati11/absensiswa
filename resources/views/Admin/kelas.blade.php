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

                    <form action="{{ route('logout') }}" method="POST" class="d-flex align-items-center">
                        @csrf
                        <button type="submit" class="btn btn-danger text-center" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">
                            <i class="fas fa-sign-out-alt me-1" style="font-size: 0.8rem;"></i> Logout
                        </button>
                    </form>

                </div>

        </nav>

        <div class="container">
            <button class="btn btn-primary mt-2 ms-1 mb-2" data-bs-toggle="modal" data-bs-target="#tambahModal">
                <i class="fas fa-plus"></i> Tambah Kelas
            </button>
        
            <div class="card mt-3 mx-auto" style="max-width: 1000px; width: 100%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-bottom: 20px;">
                <div class="card-header bg-primary text-white">
                    <h5 class="text-center">Data Kelas</h5>
                </div>
                <div class="card-body p-3"> <!-- Menambahkan padding pada card-body -->
                    <table class="table table-bordered table-striped mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Jurusan</th>
                                <th class="text-center">Tingkat Kelas</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas as $absis)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $absis->jurusan }}</td>
                                    <td class="text-center">{{ $absis->tingkat_kelas }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-success btn-sm me-auto" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $absis->id }}">
                                            <i class="fas fa-pen"></i> Edit
                                        </button>
                                        <br><br>
                                        <form action="{{ route('destroy', $absis->id) }}" method="post">
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
        <!-- Edit Modal -->
        @foreach ($kelas as $absis)
            <div class="modal fade" id="editModal{{ $absis->id }}" tabindex="-1"
                aria-labelledby="editModalLabel{{ $absis->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel{{ $absis->id }}">Edit Kelas {{ $absis->id }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('update', $absis->id) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="mb-3">
                                    <label for="jurusan" class="form-label">jurusan</label>
                                    <input type="text" class="form-control" id="jurusan" name="jurusan"
                                        value="{{ $absis->jurusan }}">
                                </div>
                                <div class="mb-3">
                                    <label for="nis" class="form-label">Tingkat Kelas</label>
                                    <input type="text" class="form-control" id="tingkat_kelas" name="tingkat_kelas"
                                        value="{{ $absis->tingkat_kelas }}">
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    {{-- tambahkelas --}}
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add your form elements for adding a new student here -->
                    <form method="post" action="{{ route('kelas.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <input type="text" class="form-control" id="jurusan" name="jurusan">
                            @error('jurusan')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tingkat_kelas" class="form-label">Tingkat Kelas</label>
                            <input type="text" class="form-control" id="tingkat_kelas" name="tingkat_kelas">
                            @error('tingkat_kelas')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- Content Start -->
