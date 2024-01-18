@extends('layouts.sidebar')

@section('content')
    <style>
        .container {
            margin-top: 30px;
        }

        /* Card style for profile information */
        .card {
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            margin-bottom: 0;
        }

        .card-text {
            margin-bottom: 10px;
        }
    </style>
    <div class="content">

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

        <div class="container mt-3">
            <h2 class="text-center mb-4"
                style="color: #3498db; font-size: 2.5rem; font-weight: bold; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);">
                PROFIL SISWA
            </h2>

            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Profile information -->
                            <h5 class="card-title text-center mb-4">IDENTITAS SISWA</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Nama:</strong> {{ auth()->user()->name }}</li>
                                <li class="list-group-item"><strong>Email:</strong> {{ auth()->user()->email }}</li>
                                <li class="list-group-item"><strong>Nis:</strong> {{ auth()->user()->nis }}</li>
                                <li class="list-group-item"><strong>Jenis
                                        Kelamin:</strong>{{ auth()->user()->jenis_kelamin }}</li>
                                <li class="list-group-item"><strong>Tanggal
                                        Lahir:</strong>{{ auth()->user()->tanggal_lahir }}</li>
                                <li class="list-group-item"><strong>Alamat:</strong> {{ auth()->user()->alamat }}</li>
                                <li class="list-group-item">
                                    <strong>Kelas:</strong>{{ auth()->user()->kelas->tingkat_kelas }}
                                </li>
                                <li class="list-group-item"><strong>Jurusan:</strong>{{ auth()->user()->kelas->jurusan }}
                                </li>
                                <li class="list-group-item"><strong>No Telepon:</strong>{{ auth()->user()->no_tlp }}</li>
                            </ul>
                        </div>

                        <div class="col-md-6">
                            <!-- Profile picture -->
                            <div class="text-center">
                                <h5 class="card-title mb-4">FOTO PROFIL</h5>
                                <img src="{{ asset('storage/' . auth()->user()->foto) }}"
                                    class="card-img-top rounded-circle img-fluid" alt="Profile Picture"
                                    style="width: 150px; height: 150px; border-radius: 50%;">
                            </div>

                            @php
                                $user = auth()->user();
                            @endphp

                            <form action="{{ route('upload-photo.update', ['id' => $user->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group mt-3 text-center">
                                    <label for="foto">Unggah Foto Baru:</label>
                                    <input type="file" class="form-control-file" id="foto" name="foto">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mt-2 btn-block">Unggah Foto</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
