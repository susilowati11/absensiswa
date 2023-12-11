@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nis" class="col-md-4 col-form-label text-md-end">NIS</label>
                                        <input type="number" class="form-control" id="nis" name="nis" required>
                                        @error('nis')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jenis_kelamin" class="col-md-4 col-form-label text-md-end">Jenis
                                            Kelamin</label>
                                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                            <option value="laki-laki"
                                                {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>
                                                Laki-Laki</option>
                                            <option value="perempuan"
                                                {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal_lahir" class="col-md-4 col-form-label text-md-end">Tanggal
                                            Lahir</label>
                                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                            required>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_tlp" class="col-md-4 col-form-label text-md-end">No Telepon</label>
                                        <input type="number" class="form-control" id="no_tlp" name="no_tlp" required>
                                    </div>
                                </div>

                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="foto" class="col-md-4 col-form-label text-md-end">Foto Siswa</label>
                                        <input type="file" class="form-control" id="foto" name="foto">
                                    </div>
                                </div> --}}


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="alamat" class="col-md-4 col-form-label text-md-end">Alamat</label>
                                        <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                   
                                    <div class="form-group">
                                        <label for="kelas_id" class="form-label">Kelas</label>
                                        <select class="form-select" id="kelas_id" name="kelas_id" required>
                                            <option value="" disabled {{ old('kelas_id') == '' ? 'selected' : '' }}>Pilih kelas</option>
                                            @if(isset($kelas))
                                                @foreach ($kelas as $kelasItem)
                                                    <option value="{{ $kelasItem->id }}" {{ old('kelas_id') == $kelasItem->id ? 'selected' : '' }}>
                                                        {{ $kelasItem->tingkat_kelas }} - {{ $kelasItem->jurusan }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password-confirm"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row mb-0"> --}}
                            {{-- <div class="col-md-6 offset-md-4"> --}}
                            <button type="submit" class="btn btn-primary" style="width: 700px">
                                Daftar
                            </button>
                            {{-- </div> --}}
                            {{-- </div> --}}
                        </form>
                        <style>
                            body {
                                background-color: #f8f9fa;
                                /* Warna latar belakang */
                            }

                            .card {
                                margin-top: 50px;
                                border: 1px solid #ddd;
                                /* Garis tepi kartu */
                                border-radius: 8px;
                                /* Sudut bulat kartu */
                                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                                /* Bayangan kartu */
                            }

                            .card-header {
                                background-color: #007bff;
                                /* Warna latar belakang header kartu */
                                color: #fff;
                                /* Warna teks header kartu */
                                border-bottom: 1px solid #0069d9;
                                /* Garis tepi bawah header kartu */
                            }

                            .card-body {
                                padding: 20px;
                                /* Ruang di dalam kartu */
                            }

                            label {
                                font-weight: bold;
                                margin-bottom: 0.5rem;
                            }

                            input {
                                margin-bottom: 1rem;
                            }

                            .btn-primary {
                                background-color: #007bff;
                                /* Warna tombol login */
                                border-color: #007bff;
                            }

                            .btn-primary:hover {
                                background-color: #0056b3;
                                /* Warna hover tombol login */
                                border-color: #0056b3;
                            }

                            .btn-link {
                                color: #007bff;
                                /* Warna tautan lupa kata sandi */
                            }

                            .btn-link:hover {
                                text-decoration: underline;
                                /* Garis bawah pada hover tautan lupa kata sandi */
                            }
                        </style>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
