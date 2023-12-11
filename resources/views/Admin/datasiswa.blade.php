@extends('layouts.sidebar')

@section('content')
    <div class="content">
        <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
            <!-- ... (existing navbar code) ... -->
        </nav>
        <div class="container mt-3">
            <h2>Data Siswa dengan Registrasi</h2>

            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>NIS</th>
                        <th>Kelas</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Nomor Telepon</th>
                        <th>Email</th>
                        <th>User Id</th>
                        <!-- Add other table headers as needed -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datasiswa as $siswa)
                       
                            <tr>
                                <td>{{ $siswa->name }}</td>
                                <td>{{ $siswa->nis }}</td>
                                <td>{{ $siswa->kelas_id }}</td>
                                <td>{{ $siswa->jenis_kelamin }}</td>
                                <td>{{ $siswa->tanggal_lahir }}</td>
                                <td>{{ $siswa->alamat }}</td>
                                <td>{{ $siswa->no_tlp }}</td>
                                <td>{{ $siswa->email }}</td>
                                <td>{{ $siswa->id }}</td>
                                <!-- Add other table cells as needed -->
                            </tr>
                     
                    @endforeach
                </tbody>
                
                </tbody>
            </table>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <!-- ... (your existing script tags) ... -->

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
@endsection