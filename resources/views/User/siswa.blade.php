@extends('layouts.sidebar')

@section('content')
    <div class="content">
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
                            <p class="card-text">Nama: {{ auth()->user()->name }}</p>
                            <p class="card-text">Email: {{ auth()->user()->email }}</p>
                            <p class="card-text">Nis: {{ auth()->user()->nis }}</p>
                            <p class="card-text">Jenis Kelamin: {{ auth()->user()->jenis_kelamin }}</p>
                            <p class="card-text">Tanggal Lahir: {{ auth()->user()->tanggal_lahir }}</p>
                            <p class="card-text">Alamat: {{ auth()->user()->alamat }}</p>
                            <p class="card-text">Kelas: {{ auth()->user()->kelas->tingkat_kelas }}</p>
                            <p class="card-text">Jurusan: {{ auth()->user()->kelas->jurusan }}</p>
                            <p class="card-text">No Telepon: {{ auth()->user()->no_tlp }}</p>
                            <!-- Add other profile information here -->
                        </div>
                    </div>
                </div>

                {{-- <div class="col-md-6">
                    <!-- Profile picture -->
                    <div class="card">
                        <img src="{{ asset('path/to/profile-picture.jpg') }}" class="card-img-top" alt="Profile Picture">
                        <div class="card-body">
                            <h5 class="card-title">Profile Picture</h5>
                            <!-- Add other details related to the profile picture here -->
                        </div>
                    </div>
                </div>
            </div> --}}

            <!-- Add other sections of the profile as needed -->

        </div>
    </div>

    <!-- JavaScript Libraries -->
    <!-- ... (your existing script tags) ... -->

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
@endsection