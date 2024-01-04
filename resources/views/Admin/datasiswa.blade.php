@extends('layouts.sidebar')

@section('content')
    <div class="content px-2">
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
            </div>
        </nav>

        <button class="btn btn-primary mt-2 ms-1 mb-2" data-bs-toggle="modal" data-bs-target="#tambahModal" style="background-color: #3498db; border-color: #3498db; color: #ffffff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); border-radius: 20px;">
            <i class="fas fa-plus"></i> Tambah Siswa
        </button>  
            <div class="card mt-0 mx-auto" style="max-width: 1000px; width: 100%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-bottom: 20px;">
                <div class="card-header bg-primary text-white">
                    <h5 class="text-center">Data Siswa</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-center">No</th>
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
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $siswa->name }}</td>
                                    <td class="text-center">{{ $siswa->nis }}</td>
                                    <td class="text-center">{{ $siswa->kelas->tingkat_kelas }} - {{ $siswa->kelas->jurusan }} </td>
                                    <td class="text-center">{{ $siswa->jenis_kelamin }}</td>
                                    <td class="text-center">{{ $siswa->tanggal_lahir }}</td>
                                    <td class="text-center">{{ $siswa->alamat }}</td>
                                    <td class="text-center">{{ $siswa->no_tlp }}</td>
                                    <td class="text-center">{{ $siswa->email }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-warning btn-sm me-auto" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $siswa->id }}" style="font-size: 0.8rem;">
                                            <i class="fas fa-pen"></i> Edit
                                        </button>
                                    
                                        <form action="{{ route('destroy', $siswa->id) }}" method="post" class="mt-2">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" id="btn-delete"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" style="font-size: 0.8rem;">
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
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nis" class="form-label">NIS</label>
                                <input type="text" class="form-control" id="nis" name="nis"
                                    value="{{ old('nis') }}">
                                @error('nis')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="kelas_id" class="form-label">Kelas</label>
                                <select class="form-select" id="kelas_id" name="kelas_id">
                                    <option value="" disabled selected>Pilih kelas</option>
                                    @foreach ($kelas as $kelasItem)
                                        <option value="{{ $kelasItem->id }}"
                                            @if (old('kelas_id') == $kelasItem->id) selected @endif>
                                            {{ $kelasItem->tingkat_kelas }} - {{ $kelasItem->jurusan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kelas_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="" disabled selected>Pilih jenis kelamin</option>
                                    <option value="Laki-laki" @if (old('jenis_kelamin') == 'Laki-laki') selected @endif>Laki-laki
                                    </option>
                                    <option value="Perempuan" @if (old('jenis_kelamin') == 'Perempuan') selected @endif>Perempuan
                                    </option>
                                </select>
                                @error('jenis_kelamin')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                    value="{{ old('tanggal_lahir') }}">
                                @error('tanggal_lahir')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="no_tlp" class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control" id="no_tlp" name="no_tlp"
                                    value="{{ old('no_tlp') }}">
                                @error('no_tlp')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
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
                                        value="{{ $siswa->name }}">
                                    @error('edit_name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nis">NIS</label>
                                    <input type="text" class="form-control" id="nis" name="nis"
                                        value="{{ $siswa->nis }}">
                                    @error('edit_nis')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kelas_id" class="form-label">Kelas</label>
                                    <select class="form-select" id="kelas_id" name="kelas_id">
                                        <option value="" disabled selected>Pilih kelas</option>
                                        @foreach ($kelas as $kelasItem)
                                            <option value="{{ $kelasItem->id }}"
                                                {{ $siswa->kelas_id == $kelasItem->id ? 'selected' : '' }}>
                                                {{ $kelasItem->tingkat_kelas }} - {{ $kelasItem->jurusan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('edit_kelas_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                        <option value="" disabled>Pilih jenis kelamin</option>
                                        <option value="Laki-laki" {{ $siswa->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ $siswa->jenis_kelamin == 'p  erempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('edit_jenis_kelamin')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                
                                

                                <div class="mb-3">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                        value="{{ $siswa->tanggal_lahir }}">
                                    @error('edit_tanggal_lahir')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ $siswa->alamat }}</textarea>
                                    @error('edit_alamat')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="no_tlp">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="no_tlp" name="no_tlp"
                                        value="{{ $siswa->no_tlp }}">
                                    @error('edit_no_tlp')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $siswa->email }}">
                                    @error('edit_email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
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
