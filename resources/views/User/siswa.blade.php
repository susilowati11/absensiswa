@extends('layouts.sidebar')

@section('content')
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

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary text-center">Logout</button>
                    </form>
                </div>
        </nav>
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
        <!-- Navbar Start -->
        <!-- ... (your existing navbar code) ... -->

        <div class="container mt-3">
            <h2>Profile</h2>

            <div class="row">
                <div class="col-md-6">
                    <!-- Profile information -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Profile</h5>
                            {{-- <img src="{{ asset('path/to/profile-picture.jpg') }}" class="card-img-top" alt="Profile Picture"> --}}
                            <p class="card-text"><strong>Nama:</strong> {{ auth()->user()->name }}</p>
                            <p class="card-text"><strong>Email:</strong> {{ auth()->user()->email }}</p>
                            <p class="card-text"><strong>Nis:</strong> {{ auth()->user()->nis }}</p>
                            <p class="card-text"><strong>Jenis Kelamin:</strong> {{ auth()->user()->jenis_kelamin }}</p>
                            <p class="card-text"><strong>Tanggal Lahir:</strong> {{ auth()->user()->tanggal_lahir }}</p>
                            <p class="card-text"><strong>Alamat:</strong> {{ auth()->user()->alamat }}</p>
                            <p class="card-text"><strong>Kelas:</strong> {{ auth()->user()->kelas->tingkat_kelas }}</p>
                            <p class="card-text"><strong>Jurusan:</strong> {{ auth()->user()->kelas->jurusan }}</p>
                            <p class="card-text"><strong>No Telepon:</strong> {{ auth()->user()->no_tlp }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Profile picture -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Profile Picture</h5>
                            <img src="{{ asset('storage/' . auth()->user()->foto) }}" class="card-img-top"
                                alt="Profile Picture">
                                @php
                                    $user = auth()->user();
                                @endphp
                            <form action="{{ route('upload-photo', ['id' => $user->id] )  }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="foto">Unggah Foto Baru:</label>
                                    <input type="file" class="form-control-file" id="foto" name="foto">
                                </div>
                                <button type="submit" class="btn btn-primary">Unggah Foto</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Add other sections of the profile as needed -->

        </div>
    </div>

    <!-- JavaScript Libraries -->
    <!-- ... (your existing script tags) ... -->

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
@endsection
